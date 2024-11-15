<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained();

            $table->foreignId("customer_id")->nullable()->constrained();

            $table->foreignId("worker_id")->nullable()->constrained();

            $table->foreignId("device_id")->nullable()->constrained();

            $table->string("play_type")->nullable();

            $table->integer("play_time")->nullable();

            $table->decimal("time_cost", 10, 2)->nullable();

            $table->decimal("items_cost", 10, 2)->nullable();

            $table->decimal('total_cost', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
