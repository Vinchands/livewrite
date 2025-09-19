<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User as Author;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'completed',
    ];
    
    protected $attributes = [
        'completed' => false,
    ];
    
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
