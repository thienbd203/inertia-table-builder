<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasPrefix;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasSuffix;

class NumberField extends AbstractField
{
    use HasPrefix, HasSuffix;

    protected static function getType(): string
    {
        return 'number';
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'prefix' => $this->getPrefix(),
            'suffix' => $this->getSuffix(),
        ]);
    }
}
