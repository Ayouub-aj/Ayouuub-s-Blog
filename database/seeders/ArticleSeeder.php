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
        $titles = [
            'Getting Started with Laravel',
            'Mastering Route Model Binding',
            'Building Reusable Blade Components',
            'Eloquent ORM Deep Dive',
            'Docker for PHP Developers',
            'Nginx Performance Tips for Laravel',
            'PHP 8.2 Features You Should Use',
            'How to Write Cleaner Controllers',
            'Service Layer Patterns in Laravel',
            'Securing Forms with CSRF',
            'How to Design Better Database Indexes',
            'Testing Laravel Apps with Confidence',
            'CI Pipelines for Laravel Projects',
            'Deploying Laravel to the Cloud',
            'Laravel Queues for Background Jobs',
            'Practical Caching Strategies',
            'Linux Commands Every Developer Needs',
            'Monitoring Application Errors',
            'Domain-Driven Design Basics',
            'REST API Best Practices',
            'Pagination UX Patterns',
            'Building Multi-Step Forms',
            'Debugging SQL Query Bottlenecks',
            'Writing Better Commit Messages',
            'How to Plan Sprint Tasks',
            'Improving Team Code Reviews',
            'Structuring Large Blade Projects',
            'Authentication Flow Explained',
            'How to Work with Draft Content',
            'From Draft to Published: Content Workflow',
            'Practical Security Checklist',
            'Database Migration Safety Tips',
            'Feature Flags for Safer Releases',
            'How to Keep Technical Debt Low',
            'Making Developer Onboarding Easier',
            'Scalable Category Taxonomy Design',
            'Modern UI Principles for Blogs',
            'Accessibility Basics for Web Apps',
            'Building a Search-Friendly Blog',
            'Clean Architecture in Practice',
        ];

        foreach ($titles as $index => $title) {
            $categoryId = ($index % 12) + 1;
            $userId = ($index % 5) + 1;
            $isDraft = $index % 4 === 0;

            \App\Models\Article::create([
                'title' => $title,
                'content' => 'This article explores ' . strtolower($title) . '. '
                    . 'It includes practical examples, step-by-step guidance, and production-focused tips. '
                    . 'Use this content as a starting point, then adapt it to your project context.',
                'status' => $isDraft ? 'draft' : 'published',
                'category_id' => $categoryId,
                'user_id' => $userId,
            ]);
        }
    }
}
