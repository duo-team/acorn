<?php

namespace DuoTeam\Acorn\Database;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    const CREATED_AT = 'post_date';

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = 'post_modified';
}