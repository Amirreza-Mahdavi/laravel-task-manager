<?php 

namespace App\Enums;

enum TaskStatus: string {
    case TODO = "TODO";
    case DOING = "DOING";
    case DONE = "DONE";
}