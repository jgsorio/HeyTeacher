<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['question'];

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function likes(): Attribute
    {
        return new Attribute(get: fn () => $this->votes()->sum('likes'));
    }

    public function dislikes(): Attribute
    {
        return new Attribute(get: fn () => $this->votes()->sum('dislikes'));
    }
}
