<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Costs\CostCreateRequest;
use App\Services\CostService;
use App\Services\UserService;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CostController extends Controller
{

    public function __construct(readonly private CostService $costService,readonly  private UserService $userService){
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $costs = $this->costService->getAllCosts(request()->toArray(),true);
        $title = ' درخواست های پرداخت';
        return view('user.cost.index', [
            'costs' => $costs,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'ایجاد درخواست جدید جدید';
        $user = $this->userService->getUserById(auth()->user()->id);
        return view('user.cost.create', [
            'title' => $title,
            'user' => $user
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CostCreateRequest $costCreateRequest)
    {
        $this->costService->createCost($costCreateRequest->validated());
        toast('اطلاعات با موفقیت ایجاد شد', 'success');
        return redirect()->route('payments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cost = $this->costService->getCostById($id,true);
        $user = $this->userService->getUserById(auth()->id());
        $title = $cost->amount;
        return view('user.cost.show', [
            'cost' => $cost,
            'user' => $user,
            'title' => $title
        ]);
    }

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
