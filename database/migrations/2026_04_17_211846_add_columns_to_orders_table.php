<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {

            if (!Schema::hasColumn('orders', 'product_name')) {
                $table->string('product_name')->after('id');
            }

            if (!Schema::hasColumn('orders', 'quantity')) {
                $table->integer('quantity')->after('product_name');
            }

            if (!Schema::hasColumn('orders', 'status')) {
                $table->string('status')->default('pending')->after('quantity');
            }

        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['product_name', 'quantity', 'status']);
        });
    }
};