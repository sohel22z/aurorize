<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'iso_code',
        'flag',
        'currency',
        'currency_symbol'
    ];

    public function user()
    {
        return $this->hasMany('App\User', 'country_id', 'id');
    }

    // This is a recommended way to declare event handlers
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($Country) {
            foreach ($Country->user as $user) {
                $user->delete();
            }
        });
    }
}
