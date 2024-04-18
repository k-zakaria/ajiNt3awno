<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentair extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'article_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function commentairs()
    {
        return $this->hasMany(Commentair::class, 'commentair_id');
    }
}
