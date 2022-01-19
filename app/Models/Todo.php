<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Todo extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable
        = [
            'description',
            'state',
            'project_id',
            'user_id',
            'view_count'
        ];

    public function project()
    {
        $this->belongsTo(Project::class);
    }

    public function markDone()
    {
        $this->state = 'Done';
    }

    public function incrementViewCount()
    {
        $this->view_count += 1;
    }
}
