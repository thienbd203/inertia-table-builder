<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasOptions;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasRelationship;

class RadioField extends AbstractField
{
    use HasOptions;
    use HasRelationship;

    protected static function getType(): string
    {
        return 'radio';
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'options' => $this->relation ? $this->getRelationshipData() : $this->getOptions(),
        ]);
    }
}
