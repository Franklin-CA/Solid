<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\PaymentHistory;
use Carbon\Carbon;

class PaymentHistorySeeder extends Seeder
{
    public function run()
    {
        $users = [
            'Franklin Anyaya',
            'Alex Ormilla',
            'Eugene Velasco',
            'Mark Reyniel Anthony',
            'Satoru Gojo',
            'Suguru Geto',
            'Itadori Yuji',
            'Toji Fushiguro',
        ];

        $amounts = [700, 1400, 2100]; // Payment amounts
        $startDate = Carbon::create(2023, 6, 1); // Start from June 2023
        $endDate = Carbon::create(2023, 11, 30); // End in November 2023

        foreach ($users as $userName) {
            $user = User::where('name', $userName)->first();

            if ($user) {
                $date = $startDate->copy();
                while ($date <= $endDate) {
                    PaymentHistory::create([
                        'user_id' => $user->id,
                        'amount' => $amounts[array_rand($amounts)],
                        'method' => 'Cash', // Or 'Online' depending on your logic
                        'status' => 'approved',
                        'paid_at' => $date->copy()->addDays(rand(0, 5)),
                    ]);

                    $date->addMonth();
                }
            }
        }
    }
}
