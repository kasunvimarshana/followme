<?php

Config::set('app.timezone', Company::where('id', COMPANY_ID)->value('time_zone'));
config(['app.timezone' => $timezone]);
date_default_timezone_set($timezone);
$timezone = date_default_timezone_get();
date_default_timezone_set('Asia/Colombo');
\Config::set('app.timezone', 'Asia/Colombo');

$posts = Post::whereHas('categories', function($q){
    $q->where('slug', '=', Input::get('category_slug'));
})->get();

public function books(){
    return $this->hasMany(Book::class)->whereYear('books.created_at', date('Y'));
}

public function books(){
    return $this->hasMany(Book::class);
}
public function booksThisYear(){
    return $this->hasMany(Book::class)->whereYear('books.created_at', date('Y'));
}

$authors = Author::with(['books' => function($query) {
    $query->whereYear('created_at', date('Y'));
}])->get();

$year = 2018; 
$authors = Author::with(['books' => function($query) use ($year) {
    $query->whereYear('created_at', $year);
}])->get();

public function scopeStatus (Builder $query, $name) {
    return $query->whereHas('status', function ($q) use ($name) {
        $q->where('name', $name);
    });
}

return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');

$users = User::with('podcasts')->get();
foreach ($users->flatMap->podcasts as $podcast) {
    echo $podcast->subscription->created_at;
}

DB::enableQueryLog();
dd(DB::getQueryLog());

?>