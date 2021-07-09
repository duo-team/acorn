<?php

namespace DuoTeam\Acorn\Resources\Serializers;

use League\Fractal\Serializer\ArraySerializer;

class SimpleSerializer extends ArraySerializer
{
    /**
     * Serialize collection.
     *
     * @param string|bool $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data): array
    {
        return $data;
    }

    /**
     * Serialize item.
     *
     * @param string|bool $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function item($resourceKey, array $data): array
    {
        return $data;
    }
}