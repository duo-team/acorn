<?php

namespace DuoTeam\Acorn\Support\Taxonomies\Exceptions;

use DuoTeam\Acorn\Exceptions\Support\HasWordPressErrorFactoryMethods;
use RuntimeException;

class RegisterTaxonomyException extends RuntimeException
{
    use HasWordPressErrorFactoryMethods;
}