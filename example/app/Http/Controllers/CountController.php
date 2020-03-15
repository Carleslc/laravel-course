<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CountController extends Controller
{
    public function index(Request $request) {
        $counter = session()->get('counter', 0);
        $newCounter = $counter + 1;
        session(['counter' => $newCounter]);
        if ($request->expectsJson()) {
            return $newCounter;
        }
        return view('counter')->with('counter', $newCounter);
    }

    public function reset() {
        session()->forget('counter');
        session()->flash('reset', true); // This request only
        return redirect(route('counter.index'));
    }
}
