<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cost\BlockUpdateRequest;
use App\Http\Requests\Cost\CostAllRequest;
use App\Http\Requests\Cost\CostDeleteRequest;
use App\Http\Requests\Cost\CostFindRequest;
use App\Http\Requests\Cost\CostUpdateFormRequest;
use App\Http\Requests\Cost\CostUpdateRequest;
use App\Models\Cost;
use App\Services\CostService;
use Illuminate\Http\Client\Request;
use Illuminate\Http\RedirectResponse;

class CostController extends Controller
{
    public function __construct(readonly private CostService $costService){
    }

    public function changes(BlockUpdateRequest $request): RedirectResponse
    {
        Cost::whereIn('id', $request->selected_ids)->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'وضعیت هزینه‌ها با موفقیت بروزرسانی شد.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CostAllRequest $costAllRequest)
    {
        $costs = $this->costService->getAllCosts($costAllRequest->validated());
        $title = ' درخواست ها';
        return view('panel.cost.index', [
            'costs' => $costs,
            'title' => $title
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CostFindRequest $costFindRequest, Cost $cost)
    {
        $cost = $this->costService->getCostById($cost->id);
        $user = $cost->user;
        $title ="درخواست پرداخت";
        return view('panel.cost.show', [
            'cost' => $cost,
            'user' => $user,
            'title' => $title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CostUpdateFormRequest $costUpdateFormRequest, Cost $cost)
    {
        $cost = $this->costService->getCostById($cost->id);
        $user = $cost->user;
        $title = 'ویرایش درخواست';
        return view('panel.cost.edit', [
            'cost' => $cost,
            'user' => $user,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CostUpdateRequest $costUpdateRequest, Cost $cost): RedirectResponse
    {
        $this->costService->updateCost($costUpdateRequest->validated(),$cost->id);
        toast('اطلاعات با موفقیت بروزرسانی شد', 'success');
        return redirect()->route('costs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CostDeleteRequest $categoryDeleteRequest, Cost $cost): RedirectResponse
    {
        $this->costService->deleteCost($cost->id);
        toast('اطلاعات با موفقیت حذف شد', 'success');
        return redirect()->route('costs.index');
    }
}
