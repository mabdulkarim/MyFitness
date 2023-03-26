<?php

namespace App\Enums;

Enum Permissions: string
{
    case CREATE_USER = 'create users';

    case READ_USER = 'read users';

    case UPDATE_USER = 'update users';

    case DELETE_USER = 'delete users';
}
