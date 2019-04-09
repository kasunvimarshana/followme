<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Status extends Enum
{
    const DEFAULT = 1;
    const IN_PROGRESS = 2;
    const COMPLETED = 3;
}
