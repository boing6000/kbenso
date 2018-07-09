<?php

namespace LaravelEnso\FormBuilder\app\Classes;

use Illuminate\Database\Eloquent\Model;
use LaravelEnso\FormBuilder\app\Classes\Attributes\Actions;
use LaravelEnso\FormBuilder\app\Exceptions\TemplateException;

class Form
{
    private $model;
    private $template;

    public function __construct(string $template)
    {
        $this->template($template);
    }

    /**
     * @return mixed
     */
    public function getAllFields() {
        $fields = collect($this->template->sections)
            ->reduce(function ($fields, $section) {
                return $fields->merge($section->fields);
            }, collect());
        return $fields;
    }

    public function create(Model $model = null)
    {
        $this->model = $model;

        $this->method('post')
            ->build();

        return $this->template;
    }

    public function edit(Model $model)
    {
        $this->model = $model;

        $this->method('patch')
            ->build();

        return $this->template;
    }

    public function actions(array $actions)
    {
        $this->template->actions = $actions;

        return $this;
    }

    public function routePrefix(string $prefix)
    {
        $this->template->routePrefix = $prefix;

        return $this;
    }

    public function title(string $title)
    {
        $this->template->title = $title;

        return $this;
    }

    public function icon(string $icon)
    {
        $this->template->icon = $icon;

        return $this;
    }

    public function route(string $action, string $route)
    {
        $this->template->routes[$action] = $route;

        return $this;
    }

    public function options(string $name, $value)
    {
        $this->field($name)->meta->options = $value;

        return $this;
    }

    public function value(string $field, $value)
    {
        $this->field($field)->value = $value;

        return $this;
    }

    public function hide($fields)
    {
        collect($fields)->each(function ($field) {
            $this->field($field)->meta->hidden = true;
        });

        return $this;
    }

    public function hideAction(string $field)
    {
        $this->template->actionsHidden[$field] = true;
        return $this;
    }

    public function show($fields)
    {
        collect($fields)->each(function ($field) {
            $this->field($field)->meta->hidden = false;
        });

        return $this;
    }

    public function disable($fields)
    {
        collect($fields)->each(function ($field) {
            $this->field($field)->meta->disabled = true;
        });

        return $this;
    }

    public function readonly($fields)
    {
        collect($fields)->each(function ($field) {
            $this->field($field)->meta->readonly = true;
        });

        return $this;
    }

    public function meta(string $field, string $param, $value)
    {
        $this->field($field)->meta->{$param} = $value;

        return $this;
    }

    public function append($prop, $value)
    {
        if (!property_exists($this->template, 'params')) {
            $this->template->params = new \stdClass();
        }

        $this->template->params->$prop = $value;

        return $this;
    }

    public function authorize(bool $authorize)
    {
        $this->template->authorize = $authorize;

        return $this;
    }

    public function build()
    {
        if ($this->needsValidation()) {
            (new Validator($this->template))->run();
        }

        (new Builder($this->template, $this->model))->run();
    }

    private function template(string $template)
    {
        $this->template = json_decode(\File::get($template));

        if (!is_object($this->template)) {
            throw new TemplateException(__('Template is not readable'));
        }

        if(!property_exists($this->template, 'actionsHidden')){
            $this->template->actionsHidden = [];
        }

        return $this;
    }

    private function method(string $method)
    {
        $this->template->method = $method;

        if (!isset($this->template->actions)) {
            $this->template->actions = $this->defaultActions();

            return $this;
        }

        return $this;
    }

    private function defaultActions()
    {
        $actions = $this->template->method === 'post'
            ? ['store', 'back']
            : ['create', 'show', 'update', 'destroy', 'back'];

        return collect($actions)
            ->filter(function ($action) {
                return \Route::has($this->template->routePrefix.'.'.$action);
            })->toArray();
    }

    private function field(string $name)
    {
        $field = collect($this->template->sections)
            ->reduce(function ($fields, $section) {
                return $fields->merge($section->fields);
            }, collect())->first(function ($field) use ($name) {
                return $field->name === $name;
            });

        if (!$field) {
            throw new TemplateException(__(
                'The :field field is missing from the JSON template',
                ['field' => $name]
            ));
        }

        return $field;
    }

    private function needsValidation()
    {
        return config('app.env') === 'local' || config('enso.datatable.validations') === 'always';
    }
}
