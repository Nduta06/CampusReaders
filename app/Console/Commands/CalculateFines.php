<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\BorrowedItem;
use App\Models\Fine;
use Carbon\Carbon;

class CalculateFines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fines:calculate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for overdue books and generate fines';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dailyRate = 1.00; // $1.00 per day
        
        // 1. Find all active loans that are overdue
        $overdueItems = BorrowedItem::whereNull('return_date')
            ->where('due_date', '<', now())
            ->get();

        $count = 0;

        foreach ($overdueItems as $item) {
            // Calculate days overdue
            // We use 'abs' to ensure a positive number
            $dueDate = Carbon::parse($item->due_date);
            $daysOverdue = now()->diffInDays($dueDate);

            // If it's less than 1 day (e.g. hours), round up or ignore. Let's count full days.
            if ($daysOverdue < 1) continue;

            $fineAmount = $daysOverdue * $dailyRate;

            // Check if fine already exists for this transaction
            $existingFine = Fine::where('borrowed_item_id', $item->id)->first();

            if ($existingFine) {
                // Update existing fine (if it increased)
                if ($existingFine->amount_due != $fineAmount) {
                    $existingFine->update([
                        'amount_due' => $fineAmount,
                        'status' => ($existingFine->amount_paid >= $fineAmount) ? 'Paid' : 'Unpaid'
                    ]);
                    $this->info("Updated fine for Book ID {$item->book_id} (User: {$item->user_id})");
                }
            } else {
                // Create new fine
                Fine::create([
                    'user_id' => $item->user_id,
                    'borrowed_item_id' => $item->id,
                    'amount_due' => $fineAmount,
                    'amount_paid' => 0,
                    'incurred_on' => now(),
                    'status' => 'Unpaid'
                ]);
                $count++;
                $this->info("Created fine for Book ID {$item->book_id} (User: {$item->user_id})");
            }
        }

        $this->info("Fines calculation complete. Generated $count new fines.");
    }
}