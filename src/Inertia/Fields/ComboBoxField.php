<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasMultiple;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasOptions;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasRelationship;

class ComboBoxField extends AbstractField
{
    use HasMultiple;
    use HasOptions;
    use HasRelationship;

    protected static function getType(): string
    {
        return 'combobox';
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'multiple' => $this->getIsMultiple(),
            'options'  => $this->relation ? $this->getRelationshipData() : $this->getOptions(),
        ]);
    }
}
