<?php

namespace App\Enums;

Enum Permissions: string
{
    case CREATE_USER = 'create users';

    case READ_USER = 'read users';

    case UPDATE_USER = 'update users';

    case DELETE_USER = 'delete users';

    case UPDATE_EXERCISE = 'update exercises';

    case DELETE_EXERCISE = 'delete exercises';
}
