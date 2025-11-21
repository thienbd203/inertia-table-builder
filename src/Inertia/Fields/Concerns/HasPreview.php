<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns;

use Closure;

trait HasPreview
{
    public string|null|Closure|array $preview = null;

    public function preview(string|callable $preview): static
    {
        $this->preview = $preview;

        return $this;
    }

    public function getPreview(): string|null|array
    {
        return is_callable($this->preview) ?
            $this->evaluate($this->preview) : $this->preview;
    }
}
