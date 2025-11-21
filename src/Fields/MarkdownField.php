<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;

class MarkdownField extends AbstractField
{
    protected static function getType(): string
    {
        return 'markdown';
    }
}
