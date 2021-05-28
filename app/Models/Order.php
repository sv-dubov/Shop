<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'phone', 'address', 'comment', 'amount', 'status'];

    public const STATUSES = [
        0 => 'New',
        1 => 'Processed',
        2 => 'Paid',
        3 => 'Delivered',
        4 => 'Completed',
    ];

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->timezone('Europe/Kiev');
    }

    public function getUpdatedAtAttribute($value) {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->timezone('Europe/Kiev');
    }
}
