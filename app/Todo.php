<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Todo extends Model
{
    protected $guarded = ['id'];
    protected $dates = ['deadline_date'];

    public static $rules = array(
        'title' => 'required',
        'deadline_date' => 'required',
    );

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function isExpired(): bool
    {
        return Carbon::today()->gt($this->deadline_date);
    }
}
