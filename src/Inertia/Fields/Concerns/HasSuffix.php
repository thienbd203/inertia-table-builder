<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns;

use Closure;

trait HasSuffix
{
    protected string|null|Closure $suffix = null;

    public function suffix($suffix): static
    {
        $this->suffix = $suffix;

        return $this;
    }

    public function getSuffix(): ?string
    {
        return is_callable($this->suffix) ?
            $this->evaluate($this->suffix) : $this->suffix;
    }
}
