<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasQuery;
use InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters\Base\AbstractFilter;

class BooleanFilter extends AbstractFilter
{
    use HasQuery;

    protected static function getType(): string
    {
        return 'boolean';
    }

    protected function getOperators(): array
    {
        return [];
    }
}
