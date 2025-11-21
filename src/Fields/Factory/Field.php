<?php

namespace InertiaKit\InertiaTableBuilder\Inertia\Fields\Factory;

use InertiaKit\InertiaTableBuilder\Inertia\Fields\Base\AbstractField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\CheckboxField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\CheckboxListField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\ComboBoxField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\CustomField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\DateField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\DatetimeLocalField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\EmailField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\FileField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\FlatpickrField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\HiddenField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\KeyValueField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\MarkdownField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\NumberField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\PasswordField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\RadioField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\RepeaterField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\RichTextField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\SelectField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\SliderField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\TagsField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\TextareaField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\TextField;
use InertiaKit\InertiaTableBuilder\Inertia\Fields\ToggleField;

/**
 * Factory class for creating specific field instances
 */
class Field
{
    /**
     * Create a text field
     */
    public static function text(string $name): TextField
    {
        return TextField::make($name);
    }

    /**
     * Create an email field
     */
    public static function email(string $name): EmailField
    {
        return EmailField::make($name);
    }

    /**
     * Create a number field
     */
    public static function number(string $name): NumberField
    {
        return NumberField::make($name);
    }

    /**
     * Create a password field
     */
    public static function password(string $name): PasswordField
    {
        return PasswordField::make($name);
    }

    /**
     * Create a flatpickr field
     */
    public static function flatpickr(string $name): FlatpickrField
    {
        return FlatpickrField::make($name);
    }

    /**
     * Create a textarea field
     */
    public static function textarea(string $name): TextareaField
    {
        return TextareaField::make($name);
    }

    /**
     * Create a date field
     */
    public static function date(string $name): DateField
    {
        return DateField::make($name);
    }

    /**
     * Create a datetime-local field
     */
    public static function datetimeLocal(string $name): DatetimeLocalField
    {
        return DatetimeLocalField::make($name);
    }

    /**
     * Create a markdown field
     */
    public static function markdown(string $name): MarkdownField
    {
        return MarkdownField::make($name);
    }

    /**
     * Create a select field
     */
    public static function select(string $name): SelectField
    {
        return SelectField::make($name);
    }

    /**
     * Create a combobox field
     */
    public static function combobox(string $name): ComboBoxField
    {
        return ComboBoxField::make($name);
    }

    /**
     * Create a radio field
     */
    public static function radio(string $name): RadioField
    {
        return RadioField::make($name);
    }

    /**
     * Create a checkbox field
     */
    public static function checkbox(string $name): CheckboxField
    {
        return CheckboxField::make($name);
    }

    /**
     * Create a toggle field
     */
    public static function toggle(string $name): ToggleField
    {
        return ToggleField::make($name);
    }

    /**
     * Create a hidden field
     */
    public static function hidden(string $name): HiddenField
    {
        return HiddenField::make($name);
    }

    /**
     * Create a slider field
     */
    public static function slider(string $name): SliderField
    {
        return SliderField::make($name);
    }

    /**
     * Create a file upload field
     */
    public static function file(string $name): FileField
    {
        return FileField::make($name);
    }

    /**
     * Create a checkbox list field
     */
    public static function checkboxList(string $name): CheckboxListField
    {
        return CheckboxListField::make($name);
    }

    /**
     * Create a rich text editor field
     */
    public static function richText(string $name): RichTextField
    {
        return RichTextField::make($name);
    }

    /**
     * Create a repeater field
     */
    public static function repeater(string $name): RepeaterField
    {
        return RepeaterField::make($name);
    }

    /**
     * Create a key-value field
     */
    public static function keyValue(string $name): KeyValueField
    {
        return KeyValueField::make($name);
    }

    /**
     * Create a tags field
     */
    public static function tags(string $name): TagsField
    {
        return TagsField::make($name);
    }

    /**
     * Create a custom field
     */
    public static function custom(string $name): CustomField
    {
        return CustomField::make($name);
    }

    /**
     * Legacy support for the old API
     *
     * @deprecated Use specific field type methods instead
     */
    public static function make(string $name): AbstractField
    {
        return TextField::make($name);
    }
}
