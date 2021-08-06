<?php

namespace DuoTeam\Acorn\Support\Acf\Repositories;

use DuoTeam\Acorn\Support\Acf\Factories\FieldFactory;
use DuoTeam\Acorn\Support\Acf\Models\Field;
use Illuminate\Support\Collection;

class FieldsRepository
{
    /**
     * @var FieldFactory
     */
    protected $fieldFactory;

    /**
     * @param FieldFactory $fieldFactory
     */
    public function __construct(FieldFactory $fieldFactory)
    {
        $this->fieldFactory = $fieldFactory;
    }

    /**
     * Update field.x
     *
     * @param string $selector
     * @param $value
     * @param string|null $ownerId
     *
     * @return Field
     */
    public function updateField(string $selector, $value, ?string $ownerId = null): Field
    {
        update_field($selector, $value, $ownerId);

        return $this->getField($selector, $ownerId);
    }

    /**
     * Update many fields.
     *
     * @param array $fields
     * @param string|null $ownerId
     *
     * @return Collection
     */
    public function updateManyFields(array $fields, ?string $ownerId = null): Collection
    {
        return collect($fields)->map(function ($value, string $selector) use ($ownerId) {
            return $this->updateField($selector, $value, $ownerId);
        });
    }

    /**
     * Get field from database.
     *
     * @param string $selector
     * @param string|null $ownerId
     * @param bool $formatted
     *
     * @return Field
     */
    public function getField(string $selector, ?string $ownerId = null, bool $formatted = true): Field
    {
        $value = get_field($selector, $ownerId, $formatted);
        $this->configureFieldFactory($selector, $ownerId, $formatted)->setValue($value);

        return $this->fieldFactory->create();
    }

    /**
     * @param string $selector
     * @param int $row
     * @param array $value
     * @param string|null $ownerId
     */
    public function updateRow(string $selector, int $row, array $value, ?string $ownerId = null)
    {
        update_row($selector, $row, $value, $ownerId);
    }

    public function updateSubRow(array $selector, $value, ?string $ownerId = null)
    {
        update_sub_field($selector, $value, $ownerId);
    }

    /**
     * Configure field factory.
     *
     * @param string $selector
     * @param string|null $ownerId
     * @param bool $formatted
     *
     * @return FieldFactory
     */
    protected function configureFieldFactory(string $selector, ?string $ownerId, bool $formatted): FieldFactory
    {
        return $this->fieldFactory
            ->forOwnerId($ownerId)
            ->withSelector($selector)
            ->markFormatted($formatted);
    }
}