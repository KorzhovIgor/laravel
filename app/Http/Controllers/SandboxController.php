<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SandboxController extends Controller
{
    /**
     * @return View
     */
    public function create(): View
    {
        return view('test.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $path = Storage::disk('s3')->put('/', $request->file('image'));
        //$path = Storage::disk('s3')->url($path);
        //dd($path);
        //$res = Http::get('http://0.0.0.0:4566/health');
        /* Store $imageName name in DATABASE from HERE */

        return back()
            ->with('success','You have successfully upload image.')
            ->with('image', $path);

    }
}
