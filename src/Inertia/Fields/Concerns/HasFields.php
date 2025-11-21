<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;
use InertiaKit\InertiaTableBuilder\Inertia\Grids\Grid;
use InertiaKit\InertiaTableBuilder\Inertia\Tabs\Tabs;

trait HasFields
{
    protected array $fields = [];

    protected function normalizedSchema($fields): array
    {
        $normalized = [];

        foreach ($fields as $field) {
            if ($field instanceof Grid) {
                $normalized = array_merge($normalized, $field->getSchema());
            } elseif ($field instanceof Tabs) {
                $normalized = array_merge($normalized, $field->getSchema());
            } else {
                $normalized[] = $field;
            }
        }

        foreach ($normalized as $index => $norm) {
            $normalized[$index] = $norm->order($index);
        }

        return $normalized;
    }

    public function schema(array $fields): static
    {

        $this->fields = $this->normalizedSchema($fields);

        return $this;
    }

    public function fields(array $fields): static
    {
        $this->fields = $this->normalizedSchema($fields);

        return $this;
    }

    public function appendFieldToSchema(AbstractField|iterable $field): static
    {
        if ($field instanceof AbstractField) {
            $this->fields[] = $field;
        } else {
            foreach ($field as $f) {
                $this->fields[] = $f;
            }
        }

        return $this;
    }

    public function findField(string $key)
    {
        return collect($this->getFields())
            ->first(fn($field) => $field->getKey() === $key);
    }

    public function getSchema(): array
    {
        return $this->fields;
    }

    public function getFields(): array
    {
        return $this->fields;
    }
}
