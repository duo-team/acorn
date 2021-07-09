<?php

namespace DuoTeam\Acorn\Resources\Managers;

use DuoTeam\Acorn\Resources\Serializers\SimpleSerializer;
use League\Fractal\Manager as TransformerManager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\TransformerAbstract;

class ResourceTransformerManager
{
    /**
     * Transformer manager.
     *
     * @var TransformerManager
     */
    protected $transformerManager;

    /**
     * @param TransformerManager $transformerManager
     * @param SimpleSerializer $serializer
     */
    public function __construct(TransformerManager $transformerManager, SimpleSerializer $serializer)
    {
        $this->transformerManager = $transformerManager->setSerializer($serializer);
    }

    /**
     * Transform resource to item.
     *
     * @param mixed $resource
     * @param TransformerAbstract|callable|null $transformer
     *
     * @return array
     */
    public function collection($resource, $transformer = null): array
    {
        return $this->transform(
            new Collection($resource, $transformer)
        );
    }

    /**
     * Transform item resource and set it as data.
     *
     * @param mixed $resource
     * @param TransformerAbstract|callable|null $transformer
     *
     * @return array
     */
    public function item($resource, $transformer = null): array
    {
        return $this->transform(
            new Item($resource, $transformer)
        );
    }

    /**
     * Transform resource into array.
     *
     * @param ResourceInterface $resource
     *
     * @return array
     */
    protected function transform(ResourceInterface $resource): array
    {
        return $this->transformerManager->createData($resource)->toArray();
    }
}