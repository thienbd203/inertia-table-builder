<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;

class PasswordField extends AbstractField
{
    protected static function getType(): string
    {
        return 'password';
    }
}
