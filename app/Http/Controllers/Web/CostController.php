<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CostController extends Controller
{


    public function showFiles($filename): StreamedResponse
    {
        $filePath = "verifies/{$filename}";
        if (!Storage::disk('private')->exists($filePath)) {
            abort(404);
        }
        // Serve the image
        return new StreamedResponse(function () use ($filePath) {
            $stream = Storage::disk('private')->readStream($filePath);
            fpassthru($stream);
        }, 200, [
            'Content-Type' => Storage::disk('private')->mimeType($filePath),
            'Content-Length' => Storage::disk('private')->size($filePath),
            'Content-Disposition' => 'inline; filename="'.basename($filePath).'"',
        ]);
    }
}
