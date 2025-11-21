<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasPrefix;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasSuffix;

class TextField extends AbstractField
{
    use HasPrefix, HasSuffix;

    protected static function getType(): string
    {
        return 'text';
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'prefix' => $this->getPrefix(),
            'suffix' => $this->getSuffix(),
        ]);
    }
}
