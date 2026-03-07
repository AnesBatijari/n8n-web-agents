<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('potenzial_settings', function (Blueprint $table) {
            $table->id();
            $table->longText('system_prompt')->nullable();
            $table->longText('user_prompt')->nullable();
            $table->string('n8n_webhook_url')->nullable();
            $table->string('callback_url')->nullable();
            $table->string('callback_token')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('potenzial_settings');
    }
};
