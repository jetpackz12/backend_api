<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskTracker extends Model
{
    use HasFactory;

    protected $fillable = [
        'task',
        'date_time',
        'status',
    ];
}
