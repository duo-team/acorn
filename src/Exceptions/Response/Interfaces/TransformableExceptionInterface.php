<?php

namespace DuoTeam\Acorn\Exceptions\Response\Interfaces;

interface TransformableExceptionInterface
{
    /**
     * Get transformer class.
     *
     * @return string
     */
    public function getTransformer(): string;
}