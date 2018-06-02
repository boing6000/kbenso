<?php

namespace LaravelEnso\PermissionManager\app\Http\Controllers;

use App\Http\Controllers\Controller;
use LaravelEnso\PermissionManager\app\Models\Permission;
use LaravelEnso\PermissionManager\app\Forms\Builders\PermissionForm;
use LaravelEnso\PermissionManager\app\Http\Requests\ValidatePermissionRequest;

class PermissionController extends Controller
{
    public function create(PermissionForm $form)
    {
        return ['form' => $form->create()];
    }

    public function store(ValidatePermissionRequest $request, Permission $permission)
    {
        $permission = $permission->storeWithRoles(
            $request->all(),
            $request->get('roleList')
        );

        return [
            'message' => __('The permission was created!'),
            'redirect' => 'system.permissions.edit',
            'id' => $permission->id,
        ];
    }

    public function edit(Permission $permission, PermissionForm $form)
    {
        return ['form' => $form->edit($permission)];
    }

    public function update(ValidatePermissionRequest $request, Permission $permission)
    {
        $permission->updateWithRoles(
            $request->all(),
            $request->get('roleList')
        );

        return ['message' => __(config('enso.labels.savedChanges'))];
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return [
            'message' => __(config('enso.labels.successfulOperation')),
            'redirect' => 'system.permissions.index',
        ];
    }
}
