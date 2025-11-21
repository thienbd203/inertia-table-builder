<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasQuery;
use InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters\Base\AbstractFilter;
use InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters\Operator;

class TextFilter extends AbstractFilter
{
    use HasQuery;

    protected static function getType(): string
    {
        return 'text';
    }

    protected function getOperators(): array
    {
        return [
            Operator::contains(),
            Operator::notContains(),
            Operator::equals(),
            Operator::notEquals(),
            Operator::startsWith(),
            Operator::notStartsWith(),
            Operator::endsWith(),
            Operator::notEndsWith(),
        ];
    }
}
