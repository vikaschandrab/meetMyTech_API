<?php

namespace App\Mail;

use App\Models\Blog;
use App\Models\BlogSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBlogNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $blog;
    public $subscriber;

    /**
     * Create a new message instance.
     */
    public function __construct(Blog $blog, BlogSubscriber $subscriber)
    {
        $this->blog = $blog;
        $this->subscriber = $subscriber;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject("📚 New Blog Published: {$this->blog->title} - MeetMyTech")
                    ->view('emails.new-blog-notification')
                    ->with([
                        'blog' => $this->blog,
                        'subscriber' => $this->subscriber,
                        'unsubscribeUrl' => route('blog.unsubscribe', $this->subscriber->unsubscribe_token),
                        'blogUrl' => route('blogs.show', $this->blog->slug),
                    ]);
    }
}
