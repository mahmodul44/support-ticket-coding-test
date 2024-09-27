<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tracking_no',
        'subject',
        'description',
        'status',
        'admin_remarks'
    ];

    protected static function boot() {
        parent::boot();
    
        static::creating(function ($ticket) {
            $ticket->tracking_no = self::generateTrackingNumber();
        });
    }
    
    public static function generateTrackingNumber() {
        return strtoupper(substr(md5(uniqid(rand(), true)), 1, 7));
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
