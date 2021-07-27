<?php

namespace DuoTeam\Acorn\Enums\Common;

use MyCLabs\Enum\Enum;

/**
 * @method static DateTimeFormat DATETIME()
 * @method static DateTimeFormat FULL_DATE()
 * @method static DateTimeFormat FULL_TIME()
 */
class DateTimeFormat extends Enum
{
    private const DATETIME = 'Y-m-d H:i:s';
    private const FULL_DATE = 'Y-m-d';
    private const FULL_TIME = 'H:i:s';
}