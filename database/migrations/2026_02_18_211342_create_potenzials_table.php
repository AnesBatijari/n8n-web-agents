<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('potenzials', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->uuid('job_id')->unique();

            // Inputs
            $table->string('client_name');
            $table->string('url');
            $table->string('location')->nullable();   // e.g. "Wien, AT"
            $table->string('language', 10)->nullable(); // e.g. "de", "en"
            $table->text('keywords')->nullable();     // store array of keywords

            // Outputs (adjust later)
            $table->string('file')->nullable();

            // Status
            $table->string('status')->default('queued');
            $table->text('error_message')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potenzials');
    }
};
