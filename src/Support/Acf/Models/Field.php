<?php

namespace DuoTeam\Acorn\Support\Acf\Models;

class Field
{
    /**
     * Field selector.
     *
     * @var string
     */
    private $selector;

    /**
     * Field value.
     * @var mixed
     */
    private $value;

    /**
     * Field owner ID.
     *
     * @var string
     */
    private $ownerId;

    /**
     * Is field value formatted.
     *
     * @var bool
     */
    private $formatted;

    /**
     * @param string $selector
     * @param $value
     * @param string $ownerId
     * @param bool $formatted
     */
    public function __construct(
        string $selector,
        $value,
        string $ownerId,
        bool $formatted
    )
    {
        $this->selector = $selector;
        $this->value = $value;
        $this->ownerId = $ownerId;
        $this->formatted = $formatted;
    }

    /**
     * Get field selector.
     *
     * @return string
     */
    public function getSelector(): string
    {
        return $this->selector;
    }

    /**
     * Get field value.
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get owner ID.
     *
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * Is field formatted.
     *
     * @return bool
     */
    public function isFormatted(): bool
    {
        return $this->formatted;
    }
}