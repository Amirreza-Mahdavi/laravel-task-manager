<?php

namespace App\Models;

use App\Enums\TaskPriority;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskStatus;

class Task extends Model {
    protected $fillable = [
        'parent_task_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date'
    ];

    protected $casts = [
        'due_date' => 'date',
        'status' => TaskStatus::class,
        'priority' =>TaskPriority::class,
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function parentTask() {
        return $this->belongsTo(Task::class, 'psrent_task_id');
    }
    public function subTasks() {
        return $this->hasMany(Task::class, 'parent_task_id');
    }

}
