<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasQuery;
use InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters\Base\AbstractFilter;

class CustomFilter extends AbstractFilter
{
    use HasQuery;

    protected string $component;

    protected static function getType(): string
    {
        return 'custom';
    }

    public function component(string $component): static
    {
        $this->component = $component;

        return $this;
    }

    protected function getOperators(): array
    {
        return [
            Operator::equals(),
            Operator::notEquals(),
        ];
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'component' => $this->component ?? null,
        ]);
    }
}
