<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'title',
        'author',
        'description',
        'content',
        'author_id',
        'category_id'
    ];

    public function author()
    {
        return $this->hasMany(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function section()
    {
        return $this->hasMany(Section::class);
    }

    
}
