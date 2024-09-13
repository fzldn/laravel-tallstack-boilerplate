<?php

namespace App\Models;

use App\Enums\PermissionsEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use HasFactory;

    /**
     * Get the permission's label.
     */
    protected function label(): Attribute
    {
        return Attribute::make(
            get: function () {
                if ($permission = PermissionsEnum::tryFrom($this->name)) {
                    return $permission->label();
                }

                return $this->name;
            },
        );
    }
}
