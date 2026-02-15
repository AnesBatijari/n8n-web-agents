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
        Schema::create('audits', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Our internal job id that we send to n8n and receive back in callback
            $table->uuid('job_id')->unique();

            $table->string('client_name');
            $table->string('url');

            $table->string('status')->default('queued'); // queued|running|done|failed
            $table->text('error_message')->nullable();

            $table->string('file_english')->nullable();
            $table->string('file_german')->nullable();

            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->timestamps();

            $table->index(['user_id', 'created_at']);
            $table->index(['status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audits');
    }
};
