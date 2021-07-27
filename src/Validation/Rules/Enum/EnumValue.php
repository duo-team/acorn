<?php

namespace DuoTeam\Acorn\Validation\Rules\Enum;

class EnumValue extends EnumRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param mixed $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return $this->enum::isValid($value);
    }
}