<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleAllRequest;
use App\Http\Requests\Role\RoleCreateFormRequest;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Http\Requests\Role\RoleDeleteRequest;
use App\Http\Requests\Role\RoleFindRequest;
use App\Http\Requests\Role\RoleUpdateFormRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Services\RoleService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct(readonly private RoleService $roleService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(RoleAllRequest $roleAllRequest): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $roles = $this->roleService->getAllRole($roleAllRequest->validated());
        $title = 'نقش ها';
        return view('panel.role.index', [
            'roles' => $roles,
            'title' => $title
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(RoleCreateFormRequest $roleCreateFormRequest): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $title = 'ایجاد نقش';
        return view('panel.role.create', [
            'title' => $title
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleCreateRequest $roleCreateRequest): \Illuminate\Http\RedirectResponse
    {
        $role = $this->roleService->createRole($roleCreateRequest->validated());
        toast('نقش با موفقیت ایجاد شد','success');
        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoleFindRequest $roleFindRequest, Role $role): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $role = $this->roleService->getRoleById($role->id);
        $title = $role->data['display_name'];
        return view('panel.role.show', [
            'role' => $role,
            'title' => $title
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleUpdateFormRequest $roleUpdateFormRequest, Role $role): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        $role = $this->roleService->getRoleById($role->id);
        $title = $role->display_name;
        $permissions = Permission::all();
        return view('panel.role.edit', [
            'role' => $role,
            'permissions' => $permissions,
            'title' => $title
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoleUpdateRequest $roleUpdateRequest, Role $role): \Illuminate\Http\RedirectResponse
    {
        $this->roleService->updateRole($roleUpdateRequest->validated(),$role->id);
        toast('نقش با موفقیت بروز رسانی شد','success');
        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleDeleteRequest $roleDeleteRequest, Role $role): \Illuminate\Http\RedirectResponse
    {
        $this->roleService->deleteRole($role->id);
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
