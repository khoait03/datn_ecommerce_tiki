<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopActivityLog extends Model
{
    protected $table = 'shop_activity_logs';
    use HasFactory;

    protected $fillable = [
        'log_name',
        'description',
        'causer_type',
        'properties',
    ];
}
