<?php

namespace DuoTeam\Acorn\Database\Exceptions;

use DuoTeam\Acorn\Exceptions\Support\HasWordPressErrorFactoryMethods;
use RuntimeException;

class ModelRetrieveException extends RuntimeException
{
    use HasWordPressErrorFactoryMethods;
}