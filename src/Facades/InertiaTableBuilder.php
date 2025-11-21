<?php

namespace InertiaKit\InertiaTableBuilder\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \InertiaKit\InertiaTableBuilder\InertiaTableBuilder
 */
class InertiaTableBuilder extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \InertiaKit\InertiaTableBuilder\InertiaTableBuilder::class;
    }
}
