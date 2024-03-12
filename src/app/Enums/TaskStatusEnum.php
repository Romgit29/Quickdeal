<?php

namespace App\Enums;

enum TaskStatusEnum : int{
    case NOT_IN_WORK = 1;
    case IN_WORK = 2;
    case DONE = 3;
}