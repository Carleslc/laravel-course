<?php

namespace App\Http\Controllers;

use App\Helpers\StorageHelper;
use Illuminate\Http\Request;
use Storage;
use Str;

class AdminMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disk = Storage::disk('public');
        $avatars = $disk->files('avatars');
        $headers = $disk->files('headers');
        $uploaded = $disk->files('uploaded');
        return view('admin.media.index', compact('avatars', 'headers', 'uploaded'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.media.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $name = $request->file('file')->getClientOriginalName();
        StorageHelper::saveImage($request, 'file', 'uploaded', $name);
        return redirect(route('media.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $images = $request->images ?? [];
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }
        return redirect(route('media.index'));
    }
}
