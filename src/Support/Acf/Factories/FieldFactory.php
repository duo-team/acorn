<?php

namespace DuoTeam\Acorn\Support\Acf\Factories;

use DuoTeam\Acorn\Support\Acf\Models\Field;

class FieldFactory
{
    /**
     * Field selector.
     *
     * @var string
     */
    protected $selector;

    /**
     * Field value.
     *
     * @var mixed
     */
    protected $value;

    /**
     * Field owner ID.
     *
     * @var string
     */
    protected $ownerId;

    /**
     * Is field formatted.
     *
     * @var bool
     */
    protected $formatted = true;

    /**
     * Field factory constructor.
     * Reset factory to initial state.
     */
    public function __construct()
    {
        $this->resetState();
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
     * Set field selector.
     *
     * @param string $selector
     *
     * @return $this
     */
    public function withSelector(string $selector): self
    {
        $this->selector = $selector;

        return $this;
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
     * Set field value.
     *
     * @param $value
     *
     * @return $this
     */
    public function setValue($value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get field owner ID.
     *
     * @return string
     */
    public function getOwnerId(): string
    {
        return $this->ownerId;
    }

    /**
     * Set field owner ID.
     *
     * @param string $ownerId
     * @return $this
     */
    public function forOwnerId(string $ownerId): self
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * @return bool
     */
    public function isFormatted(): bool
    {
        return $this->formatted;
    }

    /**
     * @param bool $isFormatted
     * @return $this
     */
    public function markFormatted(bool $isFormatted): self
    {
        $this->formatted = $isFormatted;

        return $this;
    }

    /**
     * @return Field
     */
    public function create(): Field
    {
        $field = $this->composeField();
        $this->resetState();

        return $field;
    }

    /**
     * Reset factory state.
     *
     * @return void
     */
    protected function resetState(): void
    {
        $this->selector = null;
        $this->value = null;
        $this->ownerId = (int) get_the_ID();
        $this->formatted = true;
    }

    /**
     * Compose field instance.
     *
     * @return Field
     */
    protected function composeField(): Field
    {
        return new Field(
            $this->getSelector(),
            $this->getValue(),
            $this->getOwnerId(),
            $this->isFormatted()
        );
    }
}