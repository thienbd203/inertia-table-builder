<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasMultiple;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasOptions;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasQuery;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasRelationship;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasSearchable;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasServerside;
use InertiaKit\InertiaTableBuilder\Inertia\Tables\Filters\Base\AbstractFilter;

class SelectFilter extends AbstractFilter
{
    use HasMultiple;
    use HasOptions;
    use HasQuery;
    use HasRelationship;
    use HasSearchable;
    use HasServerside;

    protected static function getType(): string
    {
        return 'select';
    }

    protected function getOperators(): array
    {
        if ($this->getIsMultiple() === true) {
            return [
                Operator::in(),
                Operator::notIn(),
            ];
        }

        return [
            Operator::equals(),
            Operator::notEquals(),
            Operator::in(),
            Operator::notIn(),
        ];
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'multiple'   => $this->getIsMultiple(),
            'options'    => $this->relation ? $this->getRelationshipData() : $this->getOptions(),
            'searchable' => $this->getIsSearchable(),
            'serverside' => $this->getIsServerSide(),
        ]);
    }
}
