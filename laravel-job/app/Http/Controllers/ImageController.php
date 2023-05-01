<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Http\Controllers\Controller;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['create', 'store', 'destroy', 'image', 'albumAddImage']]);
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $albums = Album::with('images')->get();
        // dd($albums);

        return view('image.index', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $images = Image::all();
        return view('image.create', compact('images'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'album' => 'required|min:3|max:50',
            'image' => 'required|'
        ]);
        // dd($request->all());
        $album = Album::create(['name' => $request->get('album')]);
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $path = $image->store('upload', 'public');
                Image::create([
                    'name' => $path,
                    'album_id' => $album->id
                ]);
            }
        }
        return "<div class='alert alert-success'>Зургийн цомог болон зургийг амжилттай хадгаллаа.</div>";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $albums = Album::findOrFail($id);
        return view('image.gallery', compact('albums'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $deletedimage = Image::findOrFail($id);
        $filePath = $deletedimage->name;
        $deletedimage->delete();
        Storage::delete(['public/' . $filePath]);

        return redirect('/album')->with('Message', 'Зураг амжилттай устлаа.');
    }

    public function image(Request $request)
    {
        $this->validate($request, [

            'image' => 'required'
        ]);
        // dd($request->all());

        if ($request->hasFile('image')) {
            // dd($request);

            $albumId = $request->id;
            foreach ($request->file('image') as $image) {
                $path = $image->store('upload', 'public');
                Image::create([
                    'name' => $path,
                    'album_id' => $albumId
                ]);
            }
        }
        return redirect()->back()->with("Message", "Зураг амжилттай солигдлоо.");
    }

    public function albumAddImage(Request  $request)
    {
        $this->validate($request, [
            'image' => 'required'
        ]);
        // dd($request->id);
        if ($request->hasFile('image')) {
            $albumId = $request->id;
            $file = $request->file('image');
            $path = $file->store('upload', 'public');
            Album::where('id', $albumId)->update([
                'image' => $path,
            ]);
        }
        return redirect()->back()->with("Message", "Зураг амжилттай солигдлоо баярлалаа.");
    }
};
