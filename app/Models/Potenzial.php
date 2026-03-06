<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Potenzial extends Model
{
    protected $fillable = [
        'client_name',
        'user_id',
        'url',
        'language',
        'location',
        'keywords',
        'client_comment',
        'job_id',
        'execution_id',
        'status',
        'error_message',
        'file',
        'started_at',
        'finished_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
