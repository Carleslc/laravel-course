<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use Storage;

class StorageHelper
{
    public static function getImage($dir, $id) {
        $url = "$dir/$id";
        if (!Storage::disk('public')->exists($url)) {
            $url = "$dir/default.png";
        }
        return Storage::url($url);
    }

    public static function saveImage(Request $request, $file, $dir, $id) {
        $img = $request->file($file);
        if ($img) {
            $img->storeAs($dir, $id, 'public');
        }
    }

    public static function deleteImage($dir, $id) {
        Storage::disk('public')->delete("$dir/$id");
    }
}
