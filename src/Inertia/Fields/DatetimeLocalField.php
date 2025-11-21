<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;

class DatetimeLocalField extends AbstractField
{
    protected static function getType(): string
    {
        return 'datetime-local';
    }
}
