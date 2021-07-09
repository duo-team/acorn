<?php

namespace DuoTeam\Acorn\Resources\Transformers;

use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;

abstract class AbstractTransformer extends TransformerAbstract
{
    /**
     * Build simple item for data.
     * Just return data without any change.
     *
     * @param array $data
     *
     * @return ResourceInterface
     */
    protected function simpleItem(array $data): ResourceInterface
    {
        return $this->item($data, function ($data) {
            return $data;
        });
    }
}