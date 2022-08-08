<?php
namespace App\Permissions;

class Permission
{
    public const CAN_CREATE_CONTACTS = 'create-contacts';
    public const CAN_UPDATE_CONTACTS = 'edit-contacts';
    public const CAN_DELETE_CONTACTS = 'delete-contacts';

    public const CAN_CREATE_USERS = 'create-users';
    public const CAN_UPDATE_USERS = 'update-users';
    public const CAN_DELETE_USERS = 'delete-users';
}