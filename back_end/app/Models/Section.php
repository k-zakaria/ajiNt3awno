<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description',
        'content',
        'article_id'
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
    