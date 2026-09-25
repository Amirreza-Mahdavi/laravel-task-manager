<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Task;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function assignedTasks() {
        return $this->belongsToMany(Task::class, 'assignments');
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }
    
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
