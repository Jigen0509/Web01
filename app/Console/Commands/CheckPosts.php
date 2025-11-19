<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class CheckPosts extends Command
{
    protected $signature = 'posts:check';
    protected $description = 'Check posts in database';

    public function handle()
    {
        $total = Post::count();
        $this->info("Total posts: {$total}");

        if ($total > 0) {
            $this->info("\nLatest 5 posts:");
            Post::latest()->take(5)->get(['id', 'title', 'created_at'])->each(function ($post) {
                $this->line("ID:{$post->id} | {$post->title} | {$post->created_at}");
            });
        }

        return 0;
    }
}
