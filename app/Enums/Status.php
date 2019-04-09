<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Status extends Enum
{
    const DEFAULT = 1;
    const OPEN = 2;
    const CLOSE = 3;
}
