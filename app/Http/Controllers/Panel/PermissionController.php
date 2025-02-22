<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\PermissionAllRequest;
use App\Http\Requests\Permission\PermissionCreateFormRequest;
use App\Http\Requests\Permission\PermissionCreateRequest;
use App\Http\Requests\Permission\PermissionDeleteRequest;
use App\Http\Requests\Permission\PermissionFindRequest;
use App\Http\Requests\Permission\PermissionUpdateFormRequest;
use App\Http\Requests\Permission\PermissionUpdateRequest;
use App\Services\PermissionService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function __construct(readonly private PermissionService $permissionService,readonly private SettingService $settingService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(PermissionAllRequest $permissionAllRequest): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $setting = $this->settingService->firstSetting();
        $permissions = $this->permissionService->getAll($permissionAllRequest->toArray());
        $title = 'اجازه ها';
        return view('panel.permission.index', [
            'setting' => $setting->data,
            'permissions' => $permissions->data,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PermissionCreateFormRequest $permissionCreateFormRequest): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $setting = $this->settingService->firstSetting();
        $title = 'ایجاد اجازه ها';
        return view('panel.permission.create', [
            'setting' => $setting->data,
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionCreateRequest $permissionCreateRequest): \Illuminate\Http\RedirectResponse
    {
        $permission = $this->permissionService->store($permissionCreateRequest->validated());
        toast('اطلاعات با موفقیت ایجاد شد', 'success');
        return redirect()->route('permissions.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(PermissionFindRequest $permissionFindRequest,Permission $permission): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $setting = $this->settingService->firstSetting();
        $permission = $this->permissionService->getPermission($permission);
        $title = $permission->data['title'];
        return view('panel.permission.show', [
            'setting' => $setting->data,
            'permission' => $permission->data,
            'title' => $title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PermissionUpdateFormRequest $permissionUpdateFormRequest,Permission $permission): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $setting = $this->settingService->firstSetting();
        $permission = $this->permissionService->getPermission($permission);
        $title = $permission->data['title'];
        return view('panel.permission.edit', [
            'setting' => $setting->data,
            'permission' => $permission->data,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PermissionUpdateRequest $permissionUpdateRequest,Permission $permission): \Illuminate\Http\RedirectResponse
    {
        $permission = $this->permissionService->update($permission,$permissionUpdateRequest->validated());
        toast('اطلاعات با موفقیت بروز رسانی شد', 'success');
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PermissionDeleteRequest $permissionDeleteRequest,Permission $permission): \Illuminate\Http\RedirectResponse
    {
        $permission = $this->permissionService->delete($permission);
        toast('اطلاعات با موفقیت حذف شد', 'success');
        return redirect()->route('permissions.index');
    }

    public function assignRole(Request $request, Permission $permission): \Illuminate\Http\RedirectResponse
    {
        if ($permission->hasRole($request->role)) {
            toast(__('dashboard.roleExists'), 'warning');

            return back();
        }

        $permission->assignRole($request->role);

        toast(__('dashboard.roleAssigned'), 'info');

        return back();
    }

    public function removeRole(Permission $permission, Role $role): \Illuminate\Http\RedirectResponse
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);

            toast(__('dashboard.roleRemoved'), 'success');

            return back();
        }

        toast(__('dashboard.roleNotExists'), 'warning');

        return back();
    }

    public function search(Request $request): \Illuminate\Http\JsonResponse
    {
        $permissions = [];
        if ($request->has('q')) {
            $search = $request->q;
            $permissions = Permission::select("id", "display_name", "name")
                ->where('display_name', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->get();
        }

        $permissions = collect($permissions);

        return response()->json($permissions);
    }
}
