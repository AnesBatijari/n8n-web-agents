<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PotenzialSetting extends Model
{
    protected $fillable = [
        'system_prompt',
        'user_prompt',
        'n8n_webhook_url',
        'callback_url',
        'callback_token',
        'is_active',
    ];
}
