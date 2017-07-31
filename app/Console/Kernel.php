<?php

namespace App\Console;

use App\Models\Enterprise;
use DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $renewalDatesDB = DB::table('enterprises')->where('profile', '=', 'Premium')->get();
            $today = new \DateTime();
            foreach ($renewalDatesDB as $renewalDateDB) {
                $renewalDate = new \DateTime($renewalDateDB->renewal_date);
                $dayToChangeEnterpriseProfile = $renewalDate->add(new \DateInterval('P7D'));
                if($today > $dayToChangeEnterpriseProfile) {
                    $enterprise = Enterprise::findOrFail($renewalDateDB->id);
                    $enterprise->profile = 'Padrão';
                    $enterprise->save();

                    Mail::to('agradecaaquicontato@gmail.com')->send(new DisablePremiumAccessMail($enterprise->name));
                }
            }
        })->daily();        
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
