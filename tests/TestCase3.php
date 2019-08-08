<?php


// * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
// schedule:run

// Scheduling Artisan Commands
$schedule->command('emails:send Taylor --force')->daily();
$schedule->command(EmailsCommand::class, ['Taylor', '--force'])->daily();
$schedule->command('emails:send --force')->daily();
$schedule->command(EmailsCommand::class, ['--force'])->daily();

//Scheduling Shell Commands
$schedule->exec('node /home/forge/script.js')->daily();

//Artisan::call('queue:work');
//Artisan::call('queue:listen');
//Artisan::call('queue:work --once');
//php artisan queue:restart
//php artisan queue:listen &


?>

<?php

public function update($id)
{
  // Async
  ParseFeedJob::dispatch(Store::find($id))
      ->onQueue('feed-parse-workers');
  
  // Sync
  ParseFeedJob::dispatchNow(Store::find($id));
}

?>

<?php

// Defining Schedules
    
namespace App\Console;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

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
            DB::table('recent_users')->delete();
        })->daily();
    }
}