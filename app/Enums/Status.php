<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Status extends Enum
{
    const COMPLETED = 'completed';
    const IN_PROGRESS = 'in_progress';
    const NOT_ATTEND = 'not_attend';
}
