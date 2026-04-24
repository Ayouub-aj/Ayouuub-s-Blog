<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = [
            ['title' => 'Getting Started with Laravel', 'content' => 'Laravel makes web dev a joy...', 'status' => 'published', 'category_id' => 1],
            ['title' => 'Docker for PHP Developers',    'content' => 'Containerize everything...',    'status' => 'published', 'category_id' => 3],
            ['title' => 'Eloquent ORM Deep Dive',       'content' => 'Relations, scopes and more...', 'status' => 'published', 'category_id' => 1],
            ['title' => 'PHP 8.2 New Features',         'content' => 'Fibers, enums and readonly...', 'status' => 'published', 'category_id' => 2],
            ['title' => 'My Draft Article',             'content' => 'Work in progress...',           'status' => 'draft',     'category_id' => 4],
            ['title' => 'Another Draft',                'content' => 'Coming soon...',                'status' => 'draft',     'category_id' => 4],
            ['title' => 'Testing in Laravel',           'content' => 'Testing is key to success...',  'status' => 'draft',     'category_id' => 1],
            ['title' => 'Security in Laravel',          'content' => 'Security is key to success...', 'status' => 'draft',     'category_id' => 1],
    ];

    foreach ($articles as $article) {
        \App\Models\Article::create(array_merge($article, ['user_id' => 1]));
    }
    }
}
