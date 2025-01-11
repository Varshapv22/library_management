<?php

namespace App\Console\Commands;

use App\Models\Book;
use App\Mail\OverdueNotification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendOverdueNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:overdue-books';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notifications to members with overdue books.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch overdue books
        $overdueBooks = Book::where('status', 'borrowed')
            ->where('due_date', '<', now())
            ->whereNotNull('member_email')
            ->get();

        if ($overdueBooks->isEmpty()) {
            $this->info('No overdue books found.');
            return;
        }

        foreach ($overdueBooks as $book) {
            $memberEmail = $book->member_email;

            try {
              
                Mail::to($memberEmail)->send(new OverdueNotification($book));
                $this->info("Notification sent to {$memberEmail} for book '{$book->title}'.");
            } catch (\Exception $e) {
                $this->error("Failed to send email to {$memberEmail}: {$e->getMessage()}");
            }
        }

        $this->info('All overdue notifications have been sent.');
    }
}

