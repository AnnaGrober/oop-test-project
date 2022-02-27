<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Invite extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'event_id',
    ];

    /**
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        $event = Event::where('organizer_id', Auth::id())->orderBy('id', 'desc')->first();

        if (!empty($event)) {
            static::creating(function ($query) use ($event) {
                $query->event_id = $event->id;
            });
        }
    }

}
