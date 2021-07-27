<?php

namespace DuoTeam\Acorn\Validation\Rules\Enum;

use Illuminate\Contracts\Validation\Rule;
use MyCLabs\Enum\Enum;
use Webmozart\Assert\Assert;

abstract class EnumRule implements Rule
{
    /**
     * Enum class.
     *
     * @var string|Enum
     */
    protected $enum;

    /**
     * @param string $enum
     */
    public function __construct(string $enum)
    {
        $this->setEnum($enum);
    }

    /**
     * Set enum.
     *
     * @param string $enum
     */
    protected function setEnum(string $enum): void
    {
        Assert::isAOf($enum, Enum::class);
        $this->enum = $enum;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation.in');
    }
}