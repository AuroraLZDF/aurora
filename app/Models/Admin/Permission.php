<?php

namespace App\Models\Admin;

use \Spatie\Permission\Models\Permission as PermissionModel;

class Permission extends PermissionModel
{
    protected $connection = 'www';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
