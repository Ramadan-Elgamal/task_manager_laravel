<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
class TaskImage extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'path'];

    protected $appends = ['image_url'];
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    protected function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::url($this->path),
        );
    }
}