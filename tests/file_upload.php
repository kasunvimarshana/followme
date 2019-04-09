<?php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Http\File;
    use Illuminate\Support\Facades\Storage;

    return Storage::download('file.jpg');
    return Storage::download('file.jpg', $name, $headers);

    $url = Storage::url('file.jpg');

    $contents = Storage::get('file.jpg');

    Storage::put('avatars/1', $fileContents);

    Storage::disk('local')->put('file.txt', 'Contents');

    echo asset('storage/file.txt');

    $url = Storage::temporaryUrl(
        'file.jpg', now()->addMinutes(5)
    );

    $size = Storage::size('file.jpg');
    $time = Storage::lastModified('file.jpg');

    Storage::put('file.jpg', $contents);

    // Automatically generate a unique ID for file name...
    Storage::putFile('photos', new File('/path/to/photo'));
    // Manually specify a file name...
    Storage::putFileAs('photos', new File('/path/to/photo'), 'photo.jpg');
    Storage::putFile('photos', new File('/path/to/photo'), 'public');

    Storage::prepend('file.log', 'Prepended Text');
    Storage::append('file.log', 'Appended Text');

    Storage::copy('old/file.jpg', 'new/file.jpg');
    Storage::move('old/file.jpg', 'new/file.jpg');

    $path = $request->file('avatar')->store('avatars');
    $path = Storage::putFile('avatars', $request->file('avatar'));
    $path = $request->file('avatar')->storeAs(
        'avatars', $request->user()->id
    );
    $path = Storage::putFileAs(
        'avatars', $request->file('avatar'), $request->user()->id
    );

    $visibility = Storage::getVisibility('file.jpg');
    Storage::setVisibility('file.jpg', 'public');

    Storage::delete('file.jpg');
    Storage::delete(['file.jpg', 'file2.jpg']);

    $files = Storage::files($directory);
    $files = Storage::allFiles($directory);

    $directories = Storage::directories($directory);
    // Recursive...
    $directories = Storage::allDirectories($directory);

    Storage::makeDirectory($directory);
    Storage::deleteDirectory($directory);

    $image = Image::make(storage_path('app/public/profile.jpg'))->resize(300, 200);


?>