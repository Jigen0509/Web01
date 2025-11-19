<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;

class CleanupDuplicatePosts extends Command
{
    protected $signature = 'posts:cleanup-duplicates';
    protected $description = 'Delete all posts (cleanup duplicate test posts)';

    public function handle()
    {
        $count = Post::count();

        if ($count === 0) {
            $this->info('No posts to delete.');
            return 0;
        }

        $this->info("Found {$count} posts.");

        if ($this->confirm('Do you want to delete all posts?')) {
            Post::truncate();
            $this->info('All posts have been deleted.');
        } else {
            $this->info('Operation cancelled.');
        }

        return 0;
    }
}
