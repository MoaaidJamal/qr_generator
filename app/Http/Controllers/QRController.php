<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateQRRequest;
use App\Models\Qr;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class QRController extends Controller
{
    public function dashboard()
    {
        $qr = Qr::query()->where('user_id', auth()->id())->latest()->first();

        return Inertia::render('Dashboard', [
            'qr_path' => $qr ? Storage::url($qr->path) : '',
        ]);
    }

    public function generate(GenerateQRRequest $request)
    {
        Qr::query()->create($request->all());
        return redirect()->route('dashboard');
    }
}
