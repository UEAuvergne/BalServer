<?php

namespace App\Data;

enum BookStatus: string
{
    case Available = "available";
    case Sold = "sold";
    case Damaged = "damaged";
}
