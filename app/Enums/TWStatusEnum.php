<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TWStatusEnum extends Enum
{
    const DEFAULT = 1;
    const OPEN = 2;
    const CLOSE = 3;
    const COMPLETED = 4;
    const FAIL = 5;
    const INPROGRESS = 6;
}
