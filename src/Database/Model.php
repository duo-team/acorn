<?php

namespace DuoTeam\Acorn\Database;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable(): string
    {
        if ($this->table) {
            return $this->table;
        }

        return sprintf('%s%s', $this->getConnection()->getTablePrefix(), parent::getTable());
    }
}