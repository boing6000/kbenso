<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\PermissionManager\app\Models\PermissionGroup;
use LaravelEnso\PermissionManager\app\Forms\Builders\PermissionGroupForm;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidatePermissionGroupRequest;

class PermissionGroupController extends Controller
{
    public function create(PermissionGroupForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidatePermissionGroupRequest $request)
    {
        $group = PermissionGroup::create($request->validated());

        return [
            'message' => __('The permission group was created!'),
            'redirect' => 'system.permissionGroups.edit',
            'id' => $group->id,
        ];
    }

    public function edit(PermissionGroup $permissionGroup, PermissionGroupForm $form)
    {
        return ['form' => $form->edit($permissionGroup)];
    }

    public function update(ValidatePermissionGroupRequest $request, PermissionGroup $permissionGroup)
    {
        $permissionGroup->update($request->validated());

        return [
            'message' => __('The permission group was successfully updated'),
        ];
    }

    public function destroy(PermissionGroup $permissionGroup)
    {
        $permissionGroup->delete();

        return [
            'message' => __('The permission group was successfully deleted'),
            'redirect' => 'system.permissionGroups.index',
        ];
    }
}
