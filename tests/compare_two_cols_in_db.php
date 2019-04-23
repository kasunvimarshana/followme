<?php

    Activity::where('synced_at', '>', DB::raw('optimized_at'))->latest()->get();

    Activity::whereRaw('unsynced_at > optimized_at')->latest()->get();

    $query->where('users.start_date', '<', 'users.grade_date');

    \App\User::where(function($query) { $query->where('created_at','<','updated_at'); })->get();

    ExamsSchedule::whereDate('exam_date', '>=', Carbon::now()->toDateString());
    ExamsSchedule::where('exam_date', '>=', Carbon::now()->toDateString());

    $users = DB::table('users')->select(DB::raw("
        name,
        surname,  
        (CASE WHEN (gender = 1) THEN 'M' ELSE 'F' END) as gender_text")
    );

?>