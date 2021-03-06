<?php

namespace LaravelEnso\AvatarManager\app\Classes;

use LaravelEnso\AvatarManager\app\Models\Avatar;

class Destroyer extends Handler
{
    private $avatar;

    public function __construct(Avatar $avatar)
    {
        parent::__construct();

        $this->avatar = $avatar;
    }

    public function run()
    {
        $this->fileManager->delete(
            $this->avatar->saved_name
        );
    }
}
