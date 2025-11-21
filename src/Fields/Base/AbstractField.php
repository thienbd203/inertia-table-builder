<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields\Base;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasCopyable;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasDebounce;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasForm;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasGrid;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasInfo;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasKey;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasLabel;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasName;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasOrder;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasPlaceholder;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasReactive;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasReadOnly;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasState;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasStyle;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasTab;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasType;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\Concerns\HasVisibility;
use InertiaKit\InertiaTableBuilder\Inertia\Forms\Get;
use JsonSerializable;

abstract class AbstractField implements JsonSerializable
{
    use HasCopyable, HasGrid, HasOrder, HasTab;
    use HasDebounce, HasPlaceholder, HasReadOnly, HasStyle, HasVisibility;
    use HasForm, HasLabel, HasName, HasType;
    use HasInfo, HasKey, HasReactive, HasState;

    abstract protected static function getType(): string;

    public function __construct(string $name)
    {
        $this->name($name);
        $this->key($name);
        $this->label(ucwords(str_replace('_', ' ', $name)));
        $this->type(static::getType());
    }

    public static function make(string $name): static
    {
        return new static($name);
    }

    protected function evaluate(mixed $value, array $parameters = [])
    {
        $addParam = [
            'state'                      => $this->state,
            'get'                        => new Get($this),
            'model'                      => $this->form?->getModel(),
            $this->form?->getModelName() => $this->form?->getModel(),
        ];

        $parameters = $parameters + $addParam;
        if (! $value instanceof \Closure) {
            return $value;
        }

        $reflector = new \ReflectionFunction($value);
        $args      = [];

        foreach ($reflector->getParameters() as $param) {
            $type = $param->getType()?->getName();
            $name = $param->getName();

            // Inject based on name
            if (array_key_exists($name, $parameters)) {
                $args[] = $parameters[$name];

                continue;
            }

            // Inject based on type-hint
            if ($type && array_key_exists($type, $parameters)) {
                $args[] = $parameters[$type];

                continue;
            }

            // if didn't found, try default value
            if ($param->isDefaultValueAvailable()) {
                $args[] = $param->getDefaultValue();

                continue;
            }

            // fallback null
            $args[] = null;
        }

        return $value(...$args);
    }

    /**
     * Convert the field to an array
     */
    public function toArray(): array
    {
        return [
            'name'         => $this->getName(),
            'key'          => $this->getKey(),
            'type'         => $this->getType(),
            'label'        => $this->getLabel(),
            'placeholder'  => $this->getPlaceholder(),
            'isInline'     => $this->getIsInline(),
            'mergeClass'   => $this->getMergeClass(),
            'isDisable'    => $this->getIsDisable(),
            'hidden'       => $this->getHidden(),
            'reactive'     => $this->getIsReactive(),
            'defaultValue' => $this->getState(),
            'columnSpan'   => $this->getColumnSpan(),
            'columnOrder'  => $this->getColumnOrder(),
            'debounce'     => $this->getDebounce(),
            'copyable'     => $this->getIsCopyable(),
            'asInfo'       => $this->getInfo(),
            'grid'         => $this->getGrid(),
            'gridKey'      => $this->getGridKey(),
            'gridCol'      => $this->getGridCol(),
            'order'        => $this->getOrder(),
            'tab'          => $this->getIsTab(),
            'tabKey'       => $this->getTabKey(),
        ];
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
