<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasQuery;
use InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters\Base\AbstractFilter;

class NumberFilter extends AbstractFilter
{
    use HasQuery;

    protected static function getType(): string
    {
        return 'number';
    }

    protected function getOperators(): array
    {
        return [
            Operator::equals(),
            Operator::greater(),
            Operator::greaterAndEqual(),
            Operator::less(),
            Operator::lessAndEqual(),
            Operator::between(),
            Operator::notBetween(),
        ];
    }
}
