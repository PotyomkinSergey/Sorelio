<?php
declare(strict_types=1);
namespace App\Models;

use App\Enums\TaskStatusEnum;
use App\Mail\AfterTaskCreated;
use App\Observers\TaskCreatedObserver;
use App\Policies\TaskPolicy;
use Illuminate\Database\Eloquent\Attributes\UsePolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

#[UsePolicy(TaskPolicy::class)]
class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    public $fillable = [
        'deadline_at',
        'description',
        'status',
        'title',
    ];

    public function isDone():bool
    {
        return $this->status == TaskStatusEnum::DONE->value;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function booted(): void
    {
        static::creating(function ($post) {
            $post->user_id = Auth::id();
        });

//        static::created(function ($model) {
//            Mail::to('mywmzona@gmail.com')
//                ->send(new AfterTaskCreated($model));
//        });
//
//        static::updated(function ($model) {
//            Mail::to('mywmzona@gmail.com')
//                ->send(new AfterTaskCreated($model));
//        });

//        Task::observe(TaskCreatedObserver::class); // see \App\Providers\AppServiceProvider::boot
    }
}
