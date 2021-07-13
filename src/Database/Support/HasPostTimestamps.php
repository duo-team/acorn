<?php

namespace DuoTeam\Acorn\Database\Support;

trait HasPostTimestamps
{
    /**
     * Get the name of the "created at" column.
     *
     * @return string|null
     */
    public function getCreatedAtGmtColumn(): ?string
    {
        return static::CREATED_AT_GMT;
    }

    /**
     * Get the name of the "updated at" column.
     *
     * @return string|null
     */
    public function getUpdatedAtGmtColumn(): ?string
    {
        return static::UPDATED_AT_GMT;
    }

    /**
     * Get the fully qualified "created at" column.
     *
     * @return string
     */
    public function getQualifiedCreatedAtGmtColumn(): string
    {
        return $this->qualifyColumn($this->getCreatedAtGmtColumn());
    }

    /**
     * Get the fully qualified "updated at" column.
     *
     * @return string
     */
    public function getQualifiedUpdatedAtGmtColumn(): string
    {
        return $this->qualifyColumn($this->getUpdatedAtGmtColumn());
    }
}