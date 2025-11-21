<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns;

use InertiaKit\InertiaTableBuilder\Inertia\Form;

trait HasForm
{
    public ?Form $form = null;

    public function form(Form $form): static
    {
        $this->form = $form;

        return $this;
    }
}
