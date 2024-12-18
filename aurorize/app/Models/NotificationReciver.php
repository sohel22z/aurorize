<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationReciver extends Model
{
    use SoftDeletes;

    protected $fillable = ["notification_id", "receiver_id", "status"];

    /**
     * Get the user that owns the NotificationReciver
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }
}
