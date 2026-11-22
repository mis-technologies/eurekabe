<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Idempotent: a prior run of this migration may have partially applied
        // (MySQL DDL isn't transactional) before failing on the index name below.
        Schema::table('credit_plan_subscriptions', function (Blueprint $table) {
            if (!Schema::hasColumn('credit_plan_subscriptions', 'provider')) {
                $table->enum('provider', ['paystack', 'apple'])->default('paystack')->after('plan_id');
            }
            if (!Schema::hasColumn('credit_plan_subscriptions', 'apple_original_transaction_id')) {
                $table->string('apple_original_transaction_id')->nullable()->after('provider');
            }
        });

        if (!$this->indexExists('credit_plan_subscriptions', 'cps_apple_orig_txn_status_idx')) {
            Schema::table('credit_plan_subscriptions', function (Blueprint $table) {
                $table->index(['apple_original_transaction_id', 'status'], 'cps_apple_orig_txn_status_idx');
            });
        }
    }

    public function down(): void
    {
        Schema::table('credit_plan_subscriptions', function (Blueprint $table) {
            $table->dropIndex('cps_apple_orig_txn_status_idx');
            $table->dropColumn(['provider', 'apple_original_transaction_id']);
        });
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $connection = Schema::getConnection();
        $results = $connection->select(
            'SHOW INDEX FROM ' . $connection->getTablePrefix() . $table . ' WHERE Key_name = ?',
            [$indexName]
        );

        return count($results) > 0;
    }
};
