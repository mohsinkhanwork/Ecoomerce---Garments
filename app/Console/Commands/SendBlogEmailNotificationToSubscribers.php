<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\BlogPost;

use Illuminate\Support\Facades\Mail;
use App\Mail\BlogNotification;
use App\Subscriber;

class SendBlogEmailNotificationToSubscribers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:new_blog_to_subscribers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email notification to subscribers about new published blogs.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $postsToNotify = BlogPost::where('is_published', 1)->where("is_user_notified", 0)->get();
        $subscribers = Subscriber::all();
        if (count($postsToNotify)) {
            foreach ($subscribers as $subscriber) {
                $data['posts'] = $postsToNotify;
                Mail::to($subscriber->email)->send(new BlogNotification($data));
            }
        }
        BlogPost::where('is_published', 1)->where("is_user_notified", 0)->update(['is_user_notified' => 1]);
    }
}
