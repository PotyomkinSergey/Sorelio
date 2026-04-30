<?php
declare(strict_types=1);
namespace App\Enums;

enum TaskStatusEnum: int {
    case TODO = 1;
    case DOING = 2;
    case DONE = 3;
}
