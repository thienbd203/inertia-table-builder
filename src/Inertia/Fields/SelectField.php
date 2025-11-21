<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasMultiple;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasOptions;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasRelationship;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasSearchable;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasServerside;

class SelectField extends AbstractField
{
    use HasMultiple;
    use HasOptions;
    use HasRelationship;
    use HasSearchable;
    use HasServerside;

    protected static function getType(): string
    {
        return 'select';
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
