<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;

class ToggleField extends AbstractField
{
    protected static function getType(): string
    {
        return 'toggle';
    }
}
