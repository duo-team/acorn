<?php

namespace DuoTeam\Acorn\Http;

use DuoTeam\Acorn\Resources\Managers\ResourceTransformerManager;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Response;
use League\Fractal\TransformerAbstract;

abstract class Controller
{
    use DispatchesJobs;

    /**
     * Resource transformer manager instance.
     *
     * @var ResourceTransformerManager
     */
    protected $resourceTransformerManager;

    /**
     * HTTP response status code.
     *
     * @var int
     */
    protected $status = Response::HTTP_OK;

    /**
     * Response meta data.
     *
     * @var array
     */
    protected $meta = [];

    /**
     * Set resource transformer manager.
     *
     * @param ResourceTransformerManager $resourceTransformerManager
     *
     * @return void
     */
    public function setResourceTransformerManager(ResourceTransformerManager $resourceTransformerManager): void
    {
        $this->resourceTransformerManager = $resourceTransformerManager;
    }

    /**
     * Set controller status.
     *
     * @param int $status
     *
     * @return $this
     */
    public function withStatus(int $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Set controller meta.
     *
     * @param array $meta
     *
     * @return $this
     */
    public function withMeta(array $meta): self
    {
        $this->meta = $meta;

        return $this;
    }

    /**
     * Return item response as JSON.
     *
     * @param mixed $resource
     * @param TransformerAbstract|callable|null $transformer
     *
     * @return void
     */
    protected function item($resource, $transformer = null): void
    {
        $statusCode = $this->status;
        $response = $this->composeResponse(
            $this->resourceTransformerManager->item($resource, $transformer)
        );

        $this->resetState();
        $this->json($response, $statusCode);
    }

    /**
     * Return collection response as JSON.
     *
     * @param mixed $resource
     * @param TransformerAbstract|callable|null $transformer
     *
     * @return void
     */
    protected function collection($resource, $transformer = null): void
    {
        $statusCode = $this->status;
        $response = $this->composeResponse(
            $this->resourceTransformerManager->collection($resource, $transformer)
        );

        $this->resetState();
        $this->json($response, $statusCode);
    }

    /**
     * Send simple json.
     *
     * @param array $data
     * @param int $status
     *
     * @return void
     */
    protected function json(array $data, int $status = Response::HTTP_OK): void
    {
        wp_send_json($data, $status);
    }

    /**
     * Compose response data.
     *
     * @param array $data
     *
     * @return array
     */
    protected function composeResponse(array $data): array
    {
        return [
            'data' => $data,
            'meta' => $this->meta
        ];
    }

    /**
     * Reset http state.
     *
     * @return void
     */
    private function resetState(): void
    {
        $this->meta = [];
        $this->status = Response::HTTP_OK;
    }
}