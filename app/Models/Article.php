<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['title', 'content', 'status', 'category_id', 'user_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);  // Each article belongs to one category
    }

    public function user()
    {
        return $this->belongsTo(User::class);  // Each article belongs to one user (the blogger)
    }
}