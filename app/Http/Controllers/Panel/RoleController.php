<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\CategoryAllRequest;
use App\Http\Requests\Role\CategoryCreateFormRequest;
use App\Http\Requests\Role\CategoryCreateRequest;
use App\Http\Requests\Role\CategoryDeleteRequest;
use App\Http\Requests\Role\CategoryFindRequest;
use App\Http\Requests\Role\CategoryUpdateFormRequest;
use App\Http\Requests\Role\CategoryUpdateRequest;
use App\Services\RoleService;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(readonly private RoleService $roleService, readonly private SettingService $settingService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CategoryAllRequest $roleAllRequest): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $setting = $this->settingService->firstSetting();
        $roles = $this->roleService->getAll($roleAllRequest->validated());
        $title = 'نقش ها';
        return view('panel.role.index', [
            'setting' => $setting->data,
            'roles' => $roles->data,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CategoryCreateFormRequest $roleCreateFormRequest): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $setting = $this->settingService->firstSetting();
        $title = 'ایجاد نقش';
        return view('panel.role.create', [
            'setting' => $setting->data,
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryCreateRequest $roleCreateRequest): \Illuminate\Http\RedirectResponse
    {
        $role = $this->roleService->store($roleCreateRequest->validated());
        toast('نقش با موفقیت ایجاد شد','success');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(CategoryFindRequest $roleFindRequest, Role $role): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $setting = $this->settingService->firstSetting();
        $role = $this->roleService->getRole($role);
        $title = $role->data['display_name'];
        return view('panel.role.show', [
            'setting' => $setting->data,
            'role' => $role->data,
            'title' => $title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CategoryUpdateFormRequest $roleUpdateFormRequest, Role $role): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $setting = $this->settingService->firstSetting();
        $role = $this->roleService->getRole($role);
        $title = $role->data['display_name'];
        $permissions = Permission::all();
        return view('panel.role.edit', [
            'setting' => $setting->data,
            'role' => $role->data,
            'permissions' => $permissions,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $roleUpdateRequest, Role $role): \Illuminate\Http\RedirectResponse
    {
        $role = $this->roleService->update($role,$roleUpdateRequest->validated());
        toast('نقش با موفقیت بروز رسانی شد','success');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CategoryDeleteRequest $roleDeleteRequest, Role $role): \Illuminate\Http\RedirectResponse
    {
        $role = $this->roleService->delete($role);
        toast('نقش با موفقیت حذف شد','success');
        return redirect()->route('roles.index');
    }

    public function givePermission(Request $request, Role $role): \Illuminate\Http\RedirectResponse
    {
//        if ($role->hasPermissionTo($request->permission)) {
//            toast(__('dashboard.permissionExists'), 'warning');
//
//            return back();
//        }

        $role->givePermissionTo($request->permission);

        toast(__('dashboard.permissionAdded'), 'success');

        return back();
    }

    public function revokePermission(Role $role, Permission $permission): \Illuminate\Http\RedirectResponse
    {
        if ($role->hasPermissionTo($permission)) {
            $role->revokePermissionTo($permission);

            toast(__('dashboard.permissionRevoked'), 'warning');

            return back();
        }

        toast(__('dashboard.permissionNotExists'), 'warning');

        return back();
    }
}
