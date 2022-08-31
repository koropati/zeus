<?php
namespace App\Permissions;

class Permission
{
    public const CAN_RETRIEVE_MASTER_DATA = 'retrieve-master-data';

    public const CAN_CREATE_CONTACTS = 'create-contacts';
    public const CAN_UPDATE_CONTACTS = 'update-contacts';
    public const CAN_DELETE_CONTACTS = 'delete-contacts';
    public const CAN_RETRIEVE_CONTACTS = 'retrieve-contacts';

    public const CAN_CREATE_MY_CONTACTS = 'create-my-contacts';
    public const CAN_UPDATE_MY_CONTACTS = 'update-my-contacts';
    public const CAN_DELETE_MY_CONTACTS = 'delete-my-contacts';
    public const CAN_RETRIEVE_MY_CONTACTS = 'retrieve-my-contacts';

    public const CAN_CREATE_DEVICES = 'create-devices';
    public const CAN_UPDATE_DEVICES = 'update-devices';
    public const CAN_DELETE_DEVICES = 'delete-devices';
    public const CAN_RETRIEVE_DEVICES = 'retrieve-devices';
    public const CAN_RETRIEVE_MY_DEVICES = 'retrieve-my-devices';

    public const CAN_CREATE_DEVICE_LOGS = 'create-device-logs';
    public const CAN_UPDATE_DEVICE_LOGS = 'update-device-logs';
    public const CAN_DELETE_DEVICE_LOGS = 'delete-device-logs';
    public const CAN_RETRIEVE_DEVICE_LOGS = 'retrieve-device-logs';
    public const CAN_RETRIEVE_MY_DEVICE_LOGS = 'retrieve-my-device-logs';

    public const CAN_CREATE_USERS = 'create-users';
    public const CAN_UPDATE_USERS = 'update-users';
    public const CAN_DELETE_USERS = 'delete-users';
    public const CAN_RETRIEVE_USERS = 'retrieve-users';

    public const CAN_UPDATE_PROFILE = 'update-profile';
    public const CAN_RETRIEVE_PROFILE = 'retrieve-profile';
}