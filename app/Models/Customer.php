<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = ['id', 'crated_at', 'updated_at'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
