<?php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Http\File;
    use Illuminate\Support\Facades\Storage;

    echo \Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix() . '<br/>';
    echo \Storage::disk('public')->path('') . '<br/>';
    echo \Storage::disk('local')->url('') . '<br/>';
    echo \Storage::url('') . '<br/>';

    return Storage::download('file.jpg');
    return Storage::download('file.jpg', $name, $headers);

    $path = Storage::disk('local')->path($filename);

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

    $file = Book::findOrFail($id); 
    if (File::isFile($file->path)) { 
        $file = File::get($file); 
        $response = Response::make($file, 200); 
        $response->header('Content-Type', 'application/pdf'); 
        return $response; 
    }

    $path = public_path().'/images/article/imagegallery/' . $galleryId;
    File::makeDirectory($path, $mode = 0777, true, true);

    if(!Storage::exists('/path/to/your/directory')) {
        Storage::makeDirectory('/path/to/create/your/directory', 0775, true); //creates directory
    }

    if (Storage::directories($directory)->has('someDirectory')) {}

    //$file = Storage::disk('public')->get($filename);
    //return (new Response($file, 200))->header('Content-Type', 'image/jpeg');
    $value->link_url = Storage::url( $value->link_url );
    return Storage::download('file.jpg', $name, $headers);

    Storage::disk('local')->put('file.txt', 'Contents');
    $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
    $storagePath = Storage::disk('local')->getAdapter()->getPathPrefix();
    $path = Storage::disk('local')->getAdapter()->applyPathPrefix($filename);
    $storagePath = Storage::disk('local')->path();
    $path = Storage::disk('local')->path($filename);

?>