<?php

namespace LaravelEnso\Core\app\Forms\Builders;

use LaravelEnso\Core\app\Models\Owner;
use LaravelEnso\RoleManager\app\Models\Role;
use LaravelEnso\FormBuilder\app\Classes\Form;

class OwnerForm
{
    private const TemplatePath = __DIR__.'/../Templates/owner.json';

    private $form;

    public function __construct()
    {
        $this->form = (new Form(self::TemplatePath))
            ->options('roleList', Role::get(['name', 'id']));
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Owner $owner)
    {
        return $this->form
            ->value('roleList', $owner->roleList())
            ->append('owner_id', $owner->id)
            ->edit($owner);
    }
}
