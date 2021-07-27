<?php

namespace DuoTeam\Acorn\Support\Posts\Exceptions;

use DuoTeam\Acorn\Exceptions\Support\HasWordPressErrorFactoryMethods;
use RuntimeException;

class RegisterPostTypeException extends RuntimeException
{
    use HasWordPressErrorFactoryMethods;
}