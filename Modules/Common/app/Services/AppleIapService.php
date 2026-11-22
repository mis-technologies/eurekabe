<?php

namespace Modules\Common\Services;

use GuzzleHttp\ClientInterface;
use Imdhemy\AppStore\ClientFactory;
use Imdhemy\AppStore\Jws\AppStoreJwsGenerator;
use Imdhemy\AppStore\Jws\AppStoreJwsVerifier;
use Imdhemy\AppStore\Jws\GeneratorConfig;
use Imdhemy\AppStore\Jws\Issuer;
use Imdhemy\AppStore\Jws\Key;
use Imdhemy\AppStore\Jws\Parser;
use Imdhemy\AppStore\ValueObjects\JwsTransactionInfo;
use Lcobucci\JWT\Signer\Ecdsa\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use RuntimeException;

/**
 * Talks to Apple's App Store Server API to fetch and verify the authoritative
 * record of a transaction a client reports completing. Mirrors PaystackService's
 * role: protocol details only, nothing about our own credit/plan domain.
 */
class AppleIapService
{
    /**
     * Fetch and verify a transaction's signed info directly from Apple, given
     * only the transaction ID the client reports. We never trust anything the
     * client asserts beyond "here's an ID" — the decoded payload below is what
     * Apple's servers say actually happened, cryptographically verified.
     */
    public function getTransactionInfo(string $transactionId): JwsTransactionInfo
    {
        $jwt = $this->generateServerApiJwt();

        $response = $this->fetchTransaction($this->client(sandbox: false), $transactionId, $jwt);

        if ($response === null) {
            // Not found in production — sandbox/TestFlight transactions only resolve
            // against Apple's sandbox host.
            $response = $this->fetchTransaction($this->client(sandbox: true), $transactionId, $jwt);
        }

        if ($response === null) {
            throw new RuntimeException("Apple transaction {$transactionId} not found in production or sandbox.");
        }

        $jws = Parser::toJws($response['signedTransactionInfo']);

        if (!(new AppStoreJwsVerifier())->verify($jws)) {
            throw new RuntimeException("Apple transaction {$transactionId} failed signature verification.");
        }

        return new JwsTransactionInfo($jws);
    }

    /**
     * @return array{signedTransactionInfo: string}|null null on a 404 (not found on this host)
     */
    private function fetchTransaction(ClientInterface $client, string $transactionId, string $jwt): ?array
    {
        $response = $client->request('GET', "/inApps/v1/transactions/{$transactionId}", [
            'headers' => ['Authorization' => "Bearer {$jwt}"],
            'http_errors' => false,
        ]);

        if ($response->getStatusCode() === 404) {
            return null;
        }

        if ($response->getStatusCode() !== 200) {
            throw new RuntimeException(
                "App Store Server API returned {$response->getStatusCode()} for transaction {$transactionId}: "
                . $response->getBody()
            );
        }

        /** @var array{signedTransactionInfo: string} $body */
        $body = json_decode((string) $response->getBody(), true, flags: JSON_THROW_ON_ERROR);

        return $body;
    }

    private function client(bool $sandbox): ClientInterface
    {
        return $sandbox ? ClientFactory::createForStoreKitSandbox() : ClientFactory::createForStoreKit();
    }

    private function generateServerApiJwt(): string
    {
        $privateKeyId = (string) config('liap.appstore_private_key_id');
        $issuerId = (string) config('liap.appstore_issuer_id');
        $bundleId = (string) config('liap.appstore_bundle_id');
        $privateKeyContents = $this->readPrivateKey();

        if ($privateKeyId === '' || $privateKeyContents === '' || $issuerId === '' || $bundleId === '') {
            throw new RuntimeException('Apple App Store Server API credentials are not fully configured.');
        }

        $key = new Key($privateKeyId, InMemory::plainText($privateKeyContents));
        $issuer = new Issuer($issuerId, $bundleId, $key, new Sha256());
        $config = GeneratorConfig::forAppStore($issuer);

        return (string) (new AppStoreJwsGenerator($config))->generate();
    }

    /**
     * Prefers the base64 env var (works on platforms where mounting the .p8
     * file isn't practical); falls back to reading it from disk.
     */
    private function readPrivateKey(): string
    {
        $base64 = (string) config('liap.appstore_private_key_base64');

        if ($base64 !== '') {
            $decoded = base64_decode($base64, true);

            if ($decoded === false) {
                throw new RuntimeException('APPSTORE_PRIVATE_KEY_BASE64 is not valid base64.');
            }

            return $decoded;
        }

        $path = (string) config('liap.appstore_private_key');

        if ($path === '' || !is_file($path)) {
            return '';
        }

        return (string) file_get_contents($path);
    }
}
