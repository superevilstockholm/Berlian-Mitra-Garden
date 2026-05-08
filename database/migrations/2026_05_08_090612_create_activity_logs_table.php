<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();

            // User
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('user_name')->nullable();

            // Request
            $table->string('method', 10); // POST, PUT, PATCH, DELETE
            $table->text('route_path');
            $table->string('route_name')->nullable();

            // Client
            $table->ipAddress('ip_address')->nullable();
            $table->text('user_agent')->nullable();

            // Request payload
            $table->jsonb('payload')->nullable();

            // Response
            $table->unsignedSmallInteger('status_code')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('user_id');
            $table->index('method');
            $table->index('route_name');
            $table->index('status_code');
            $table->index('created_at');
        });

        DB::statement('
            CREATE INDEX activity_logs_payload_gin
            ON activity_logs
            USING GIN (payload)
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
