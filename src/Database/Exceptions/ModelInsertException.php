<?php

namespace DuoTeam\Acorn\Database\Exceptions;

use DuoTeam\Acorn\Exceptions\Support\HasWordPressErrorFactoryMethods;
use RuntimeException;

class ModelInsertException extends RuntimeException
{
    use HasWordPressErrorFactoryMethods;
}