Method	Description
->cron('* * * * *');	Run the task on a custom Cron schedule
->everyMinute();	Run the task every minute
->everyFiveMinutes();	Run the task every five minutes
->everyTenMinutes();	Run the task every ten minutes
->everyFifteenMinutes();	Run the task every fifteen minutes
->everyThirtyMinutes();	Run the task every thirty minutes
->hourly();	Run the task every hour
->hourlyAt(17);	Run the task every hour at 17 mins past the hour
->daily();	Run the task every day at midnight
->dailyAt('13:00');	Run the task every day at 13:00
->twiceDaily(1, 13);	Run the task daily at 1:00 & 13:00
->weekly();	Run the task every week
->weeklyOn(1, '8:00');	Run the task every week on Monday at 8:00
->monthly();	Run the task every month
->monthlyOn(4, '15:00');	Run the task every month on the 4th at 15:00
->quarterly();	Run the task every quarter
->yearly();	Run the task every year
->timezone('America/New_York');	Set the timezone



// Run once per week on Monday at 1 PM...
$schedule->call(function () {
    //
})->weekly()->mondays()->at('13:00');

// Run hourly from 8 AM to 5 PM on weekdays...
$schedule->command('foo')
          ->weekdays()
          ->hourly()
          ->timezone('America/Chicago')
          ->between('8:00', '17:00');


Method	Description
->weekdays();	Limit the task to weekdays
->sundays();	Limit the task to Sunday
->mondays();	Limit the task to Monday
->tuesdays();	Limit the task to Tuesday
->wednesdays();	Limit the task to Wednesday
->thursdays();	Limit the task to Thursday
->fridays();	Limit the task to Friday
->saturdays();	Limit the task to Saturday
->between($start, $end);	Limit the task to run between start and end times
->when(Closure);	Limit the task based on a truth test


$schedule->command('reminders:send')
                    ->hourly()
                    ->between('7:00', '22:00');

$schedule->command('reminders:send')
                    ->hourly()
                    ->unlessBetween('23:00', '4:00');

$schedule->command('emails:send')->daily()->when(function () {
    return true;
});

$schedule->command('emails:send')->daily()->skip(function () {
    return true;
});

$schedule->command('report:generate')
         ->timezone('America/New_York')
         ->at('02:00')

$schedule->command('emails:send')->withoutOverlapping();

$schedule->command('emails:send')->withoutOverlapping(10);

$schedule->command('report:generate')
                ->fridays()
                ->at('17:00')
                ->onOneServer();

