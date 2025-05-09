<?php

namespace App\Enums;

enum UserTypes: int
{
    case Admin = 1;
    case Client  = 2;
}
