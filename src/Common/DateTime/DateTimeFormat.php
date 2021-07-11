<?php

namespace DuoTeam\Acorn\Common\DateTime;

use MyCLabs\Enum\Enum;

/**
 * @method static DateTimeFormat DATETIME()
 * @method static DateTimeFormat DATE()
 * @method static DateTimeFormat TIME()
 */
final class DateTimeFormat extends Enum
{
    private const DATETIME = 'Y-m-d H:i:s';
    private const DATE = 'Y-m-d';
    private const TIME = 'H:i:s';
}