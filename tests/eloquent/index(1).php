<!-- ---------------------------------------------------------------------------------------- -->
https://laravel.com/docs/6.x/eloquent-relationships
<!-- ---------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------------------------- -->
<?php

use Illuminate\Database\Eloquent\Builder;

$posts = App\Post::whereDoesntHave('comments', function (Builder $query) {
    $query->where('content', 'like', 'foo%');
})->get();

?>
<!-- ---------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------------------------- -->
<?php

use Illuminate\Database\Eloquent\Builder;

$posts = App\Post::whereDoesntHave('comments.author', function (Builder $query) {
    $query->where('banned', 1);
})->get();

?>
<!-- ---------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------------------------- -->
<?php

use Illuminate\Database\Eloquent\Builder;

// Retrieve comments associated to posts or videos with a title like foo%...
$comments = App\Comment::whereHasMorph(
    'commentable',
    ['App\Post', 'App\Video'],
    function (Builder $query) {
        $query->where('title', 'like', 'foo%');
    }
)->get();

// Retrieve comments associated to posts with a title not like foo%...
$comments = App\Comment::whereDoesntHaveMorph(
    'commentable',
    'App\Post',
    function (Builder $query) {
        $query->where('title', 'like', 'foo%');
    }
)->get();

?>
<!-- ---------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------------------------- -->
<?php

use Illuminate\Database\Eloquent\Builder;

$comments = App\Comment::whereHasMorph(
    'commentable',
    ['App\Post', 'App\Video'],
    function (Builder $query, $type) {
        $query->where('title', 'like', 'foo%');

        if ($type === 'App\Post') {
            $query->orWhere('content', 'like', 'foo%');
        }
    }
)->get();

?>
<!-- ---------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------------------------- -->
<?php

use Illuminate\Database\Eloquent\Builder;

$comments = App\Comment::whereHasMorph('commentable', '*', function (Builder $query) {
    $query->where('title', 'like', 'foo%');
})->get();

?>
<!-- ---------------------------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------------------------- -->
<?php

use Illuminate\Database\Eloquent\Builder;

$posts = App\Post::withCount([
    'comments',
    'comments as pending_comments_count' => function (Builder $query) {
        $query->where('approved', false);
    },
])->get();

echo $posts[0]->comments_count;

echo $posts[0]->pending_comments_count;

?>
<!-- ---------------------------------------------------------------------------------------- -->