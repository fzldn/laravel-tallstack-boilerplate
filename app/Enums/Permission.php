<?php

namespace App\Enums;

enum Permission: string
{
    case USERS_CREATE = 'users.create';
    case USERS_VIEWANY = 'users.viewAny';
    case USERS_VIEW = 'users.view';
    case USERS_UPDATE = 'users.update';
    case USERS_DELETE = 'users.delete';
    case USERS_DELETEANY = 'users.deleteAny';

    case ROLES_CREATE = 'roles.create';
    case ROLES_VIEWANY = 'roles.viewAny';
    case ROLES_VIEW = 'roles.view';
    case ROLES_UPDATE = 'roles.update';
    case ROLES_DELETE = 'roles.delete';
    case ROLES_DELETEANY = 'roles.deleteAny';
    case ROLES_ATTACH = 'roles.attach';
    case ROLES_DETACH = 'roles.detach';
    case ROLES_DETACHANY = 'roles.detachAny';

    case ACTIVITIES_VIEWANY = 'activities.viewAny';

    public function label(): string
    {
        return match ($this) {
            self::USERS_CREATE => __('Create User'),
            self::USERS_VIEWANY => __('View Any Users'),
            self::USERS_VIEW => __('View User'),
            self::USERS_UPDATE => __('Update User'),
            self::USERS_DELETE => __('Delete User'),
            self::USERS_DELETEANY => __('Delete Any Users'),

            self::ROLES_CREATE => __('Create Role'),
            self::ROLES_VIEWANY => __('View Any Roles'),
            self::ROLES_VIEW => __('View Role'),
            self::ROLES_UPDATE => __('Update Role'),
            self::ROLES_DELETE => __('Delete Role'),
            self::ROLES_DELETEANY => __('Delete Any Roles'),
            self::ROLES_ATTACH => __('Attach Role'),
            self::ROLES_DETACH => __('Detach Role'),
            self::ROLES_DETACHANY => __('Detach Any Roles'),

            self::ACTIVITIES_VIEWANY => __('View Any Activities'),

            default => $this->value,
        };
    }
}
