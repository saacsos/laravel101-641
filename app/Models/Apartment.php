<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Apartment extends Model
{
    use HasFactory, SoftDeletes;

    protected $attributes = [
        'name' => "",
        'floors' => 0
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function officer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
