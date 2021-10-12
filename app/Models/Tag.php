<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $touches = ['tasks'];

    protected $fillable = ['name'];

    public function tasks() {
        return $this->belongsToMany(Task::class)
                    ->withTimestamps();
    }
}
