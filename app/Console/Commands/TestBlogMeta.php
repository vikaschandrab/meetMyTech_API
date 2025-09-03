<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Blog;

class TestBlogMeta extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:test-meta {slug}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test blog metadata for social sharing';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $slug = $this->argument('slug');

        $blog = Blog::where('slug', $slug)->with('user')->first();

        if (!$blog) {
            $this->error("Blog with slug '{$slug}' not found.");
            return;
        }

        $this->info("Blog Details:");
        $this->line("Title: " . $blog->title);
        $this->line("Author: " . $blog->user->name);
        $this->line("Author ID: " . $blog->user->id);
        $this->line("Featured Image: " . ($blog->featured_image ?? 'NULL'));
        $this->line("Author Profile Pic: " . ($blog->user->profilePic ?? 'NULL'));
        $this->line("Status: " . $blog->status);
        $this->line("Published At: " . ($blog->published_at ?? 'NULL'));

        $this->info("\nMeta Tags Preview:");
        $this->line("OG Title: " . ($blog->meta_title ?: $blog->title));
        $this->line("OG Author: " . $blog->user->name);
        $this->line("OG Image: " . ($blog->featured_image ? asset('storage/' . $blog->featured_image) : asset('meetmytech_logo.jpg')));
        $this->line("Twitter Creator: @" . str_replace(' ', '_', strtolower($blog->user->name)));

        return 0;
    }
}
