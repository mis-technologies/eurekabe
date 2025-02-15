<?php

namespace Modules\Common\Actions;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;


class OpenRouter extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'openrouter';
    }

    /**
     * Send a chat completion request to OpenRouter API
     *
     * @param array $messages
     * @param string $model
     * @return array
     * @throws \RuntimeException
     */
    // public static function chat(array $messages, string $model = 'openai/gpt-4')
    // {
    //     $client = new Client();

    //     try {
    //         $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
    //                 'HTTP-Referer' => config('app.url'),
    //                 'X-Title' => config('app.name'),
    //                 'Content-Type' => 'application/json',
    //             ],
    //             'json' => [
    //                 'model' => $model,
    //                 'messages' => $messages,
    //             ]
    //         ]);

    //         // dd($response);
    //         return json_decode($response->getBody()->getContents(), true);
    //     } catch (\Exception $e) {
    //         throw new \RuntimeException('OpenRouter API request failed: ' . $e->getMessage());
    //     }
    // }

    public static function chat(array $messages, string $model = 'openai/gpt-4', int $maxRetries = 3)
    {
        $client = new Client();
        $attempt = 0;

        while ($attempt < $maxRetries) {
            try {
                $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
                        'HTTP-Referer' => config('app.url'),
                        'X-Title' => config('app.name'),
                        'Content-Type' => 'application/json',
                    ],
                    'json' => [
                        'model' => $model,
                        'messages' => $messages,
                        'temperature' => 0.7,
                        'max_tokens' => 1000,
                        'stream' => false,
                    ],
                    'timeout' => 30,
                ]);

                $result = json_decode($response->getBody()->getContents(), true);

                // Check if we got a valid response with content
                if (isset($result['choices'][0]['message']['content'])
                    && !empty($result['choices'][0]['message']['content'])) {
                    return $result;
                }

                // If we got an empty response, wait briefly before retrying
                $attempt++;
                if ($attempt < $maxRetries) {
                    usleep(1000000); // Wait 1 second before retrying
                }

            } catch (\Exception $e) {
                Log("OpenRouter error", $e->__toString());
                $attempt++;
                if ($attempt >= $maxRetries) {
                    throw new \RuntimeException('OpenRouter API request failed: ' . $e->getMessage());
                }
                usleep(1000000); // Wait 1 second before retrying
            }
        }

        throw new \RuntimeException('OpenRouter API returned empty response after ' . $maxRetries . ' attempts');
    }

    /**
     * Stream chat completion from OpenRouter API
     *
     * @param array $messages
     * @param string $model
     * @return StreamedResponse
     */
    public static function streamChat(array $messages, string $model = 'openai/gpt-4')
    {
        $client = new Client();

        return new StreamedResponse(function () use ($client, $messages, $model) {
            $response = $client->post('https://openrouter.ai/api/v1/chat/completions', [
                'headers' => [
                    'Authorization' => 'Bearer ' . config('services.openrouter.api_key'),
                    'HTTP-Referer' => config('app.url'),
                    'X-Title' => config('app.name'),
                    'Content-Type' => 'application/json',
                    'Accept' => 'text/event-stream',
                ],
                'json' => [
                    'model' => $model,
                    'messages' => $messages,
                    'stream' => true,
                    'temperature' => 0.7,
                    'max_tokens' => 1000,
                ],
                'stream' => true,
                'timeout' => 60,
                'read_timeout' => 60,
            ]);

            $stream = $response->getBody();

            while (!$stream->eof()) {
                $line = trim($stream->read(1024));

                if (!empty($line)) {
                    $lines = explode("data: ", $line);
                    foreach ($lines as $data) {
                        if (empty($data)) {
                            continue;
                        }

                        if ($data === '[DONE]') {
                            echo "data: [DONE]\n\n";
                            flush();
                            break;
                        }

                        try {
                            $decoded = json_decode($data, true);
                            if (isset($decoded['choices'][0]['delta']['content'])) {
                                echo 'data: ' . json_encode([
                                    'content' => $decoded['choices'][0]['delta']['content'],
                                    'done' => false,
                                ]) . "\n\n";
                                flush();
                            }
                        } catch (\Exception $e) {
                            continue;
                        }
                    }
                }
            }
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
            'Connection' => 'keep-alive',
        ]);
    }




    public static function processResponse($response) {
        try {
            // Decode the JSON response
            $decoded = json_decode($response, true);
    
            // Validate JSON decoding
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('JSON decode error: ' . json_last_error_msg());
            }
    
            // Reindex array and add status field
            // $reindexed = array_map(function ($question, $index) {
            //     return array_merge($question, ['status' => 0]);
            // }, $decoded, array_keys($decoded));
    
            return array_values($decoded); // Normalize indexing
        } catch (\Exception $e) {
            // Log the error (optional: replace with logger)
            throw new \Exception('Failed to process response: ' . $e->getMessage());
        }
    }
    
    
}
