<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasOptions;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasRelationship;

class CheckboxListField extends AbstractField
{
    /**
     * Set the options for the checkbox list
     * example: ['label' => 'Technology', 'value' => 'technology']
     */
    use HasOptions;

    use HasRelationship;

    protected static function getType(): string
    {
        return 'checkbox-list';
    }

    /**
     * Convert the field to an array
     */
    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'options' => $this->relation ? $this->getRelationshipData() : $this->getOptions(),
        ]);
    }
}
