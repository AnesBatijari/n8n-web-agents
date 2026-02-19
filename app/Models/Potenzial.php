<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Potenzial extends Model
{
    protected $fillable = [
        'client_name',
        'url',
        'language_id',
        'location_id',
        'keywords',
        'job_id',
        'status',
        'error_message',
        'file_potenzial',
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
