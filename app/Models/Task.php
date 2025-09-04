<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'due_date' => 'date',
    ];

    const STATUS_TODO = 'To-Do';
    const STATUS_IN_PROGRESS = 'In Progress';
    const STATUS_DONE = 'Done';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
