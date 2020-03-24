<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\Flysystem\File;
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
        return view('admin.media.index', compact('avatars', 'headers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        return view('admin.media.upload');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $image = $request->input('image');
        if (!Str::startsWith(basename($image), 'default.png')) {
            Storage::disk('public')->delete($image);
        }
        return redirect(route('media.index'));
    }
}
