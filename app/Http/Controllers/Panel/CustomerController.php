<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\CustomerAllRequest;
use App\Http\Requests\Customer\CustomerCreateFormRequest;
use App\Http\Requests\Customer\CustomerCreateRequest;
use App\Http\Requests\Customer\CustomerDeleteRequest;
use App\Http\Requests\Customer\CustomerFindRequest;
use App\Http\Requests\Customer\CustomerUpdateFormRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    public function __construct(readonly private UserService $userService){
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CustomerAllRequest $customerAllRequest): Application|Factory|View
    {
        $customers = $this->userService->getAllUsers($customerAllRequest->validated());
        $title = ' کاربران';
        return view('panel.customer.index', [
            'customers' => $customers,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CustomerCreateFormRequest $customerCreateFormRequest): View|Factory|Application
    {
        $title = 'ایجاد کاربر جدید';
        return view('panel.customer.create', [
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerCreateRequest $customerCreateRequest): RedirectResponse
    {
        $this->userService->registerUser($customerCreateRequest->validated());
        toast('اطلاعات با موفقیت ایجاد شد', 'success');
        return redirect()->route('customers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CustomerFindRequest $customerFindRequest, User $customer): Application|Factory|View
    {
        $user = $this->userService->getUserById($customer->id);
        $title = $user->name;
        return view('panel.customer.show', [
            'customer' => $user,
            'title' => $title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomerUpdateFormRequest $customerUpdateFormRequest, User $customer): Application|Factory|View
    {
        $user = $this->userService->getUserById($customer->id);
        $title = $user->name;
        return view('panel.customer.edit', [
            'customer' => $user,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $customerUpdateRequest, User $customer): RedirectResponse
    {
        $this->userService->updateUser($customerUpdateRequest->validated(),$customer);
        toast('اطلاعات با موفقیت بروزرسانی شد', 'success');
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CustomerDeleteRequest $customerDeleteRequest, User $customer): RedirectResponse
    {
        $user = $this->userService->deleteUser($customer);
        toast('اطلاعات با موفقیت حذف شد', 'success');
        return redirect()->route('customers.index');
    }
}
