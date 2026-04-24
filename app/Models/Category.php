<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];   // Allows mass assignment of 'name'

    public function articles()
    {
        return $this->hasMany(Article::class);  // One category → many articles
    }
}