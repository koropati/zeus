<?php
namespace App\Permissions;

class Permission
{
    public const CAN_CREATE_CONTACTS = 'create-contacts';
    public const CAN_UPDATE_CONTACTS = 'edit-contacts';
    public const CAN_DELETE_CONTACTS = 'delete-contacts';
    public const CAN_RETRIEVE_CONTACTS = 'retrieve-contacts';

    public const CAN_CREATE_DEVICES = 'create-devices';
    public const CAN_UPDATE_DEVICES = 'edit-devices';
    public const CAN_DELETE_DEVICES = 'delete-devices';
    public const CAN_RETRIEVE_DEVICES = 'retrieve-devices';
    public const CAN_RETRIEVE_MY_DEVICES = 'retrieve-my-devices';

    public const CAN_CREATE_DEVICE_LOGS = 'create-device-logs';
    public const CAN_UPDATE_DEVICE_LOGS = 'edit-device-logs';
    public const CAN_DELETE_DEVICE_LOGS = 'delete-device-logs';
    public const CAN_RETRIEVE_DEVICE_LOGS = 'retrieve-device-logs';

    public const CAN_CREATE_USERS = 'create-users';
    public const CAN_UPDATE_USERS = 'update-users';
    public const CAN_DELETE_USERS = 'delete-users';
    public const CAN_RETRIEVE_USERS = 'retrieve-users';
}