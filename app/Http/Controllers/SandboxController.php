<?php

namespace App\Http\Controllers;

use App\Mail\ExportPrice;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

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

        try {
            Storage::disk('s3')->put('/', $request->file('image'));
            Mail::to('darggerrfs@gmail.com')->send(new ExportPrice());
            $success = 'You have successfully upload information.';
        } catch (Exception $exception) {
            $success = $exception->getMessage();
        }
        //$path = Storage::disk('s3')->put('/', $request->file('image'));
        //$path = Storage::disk('s3')->url($path);
        return back()
            ->with('success', $success);
            //->with('image', $path);

    }
}
