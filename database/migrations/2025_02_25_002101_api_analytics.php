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
        Schema::create('api_analytics', function (Blueprint $table) {
            $table->id();
            $table->string('method', 10);
            $table->string('endpoint');
            $table->integer('status_code');
            $table->string('ip', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->decimal('duration', 10, 2)->comment('milliseconds');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('request_size')->nullable();
            $table->integer('response_size')->nullable();
            $table->json('query_params')->nullable();
            $table->timestamp('timestamp')->index();

            // No timestamps() as we're using our own timestamp column

            // Indexes
            $table->index('endpoint');
            $table->index('method');
            $table->index('status_code');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_analytics');
    }
};
