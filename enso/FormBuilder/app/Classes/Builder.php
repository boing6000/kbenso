<?php

namespace LaravelEnso\FormBuilder\app\Classes;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Builder
{
    private $template;
    private $model;

    public function __construct($template, Model $model = null)
    {
        $this->template = $template;
        $this->model = $model;
    }

    public function run()
    {
        $this->appendConfigParams();

        $this->setValues();

        $this->computeActions();

        unset($this->template->routes, $this->template->routePrefix, $this->template->authorize);
    }

    private function setValues()
    {
        if (!$this->model) {
            return $this;
        }

        collect($this->template->sections)->each(function ($section) {
            collect($section->fields)->each(function ($field) {
//                if($field->meta->type === 'select'){
//                    $field->value = intval($this->model->{$field->name});
//                }else {
                if ($this->model->{$field->name} instanceof Carbon && isset($field->meta->format)) {
                    $field->value = $this->model->{$field->name}->format($field->meta->format);
                } else {
                    $field->value = $this->model->{$field->name};
                }
//                }
            });
        });

        return $this;
    }

    private function computeActions()
    {
        $this->template->actions = collect($this->template->actions)
            ->reduce(function ($collector, $action) {
                $actionConfig = [];
                $actionConfig['button'] = config('enso.forms.buttons.' . $action);
                $route = $this->routes[$action] ?? $this->template->routePrefix . '.' . $action;
                $actionConfig['forbidden'] = $this->isForbidden($route);

                [$routeOrPath, $value] = collect(['create', 'show', 'index'])->contains($action)
                    ? ['route', $route]
                    : ['path', route($route, is_null($this->model) ? [] : [$this->model->id], false)];

                $actionConfig[$routeOrPath] = $value;

                if ($action === 'show') {
                    $actionConfig['id'] = $this->model->id;
                }


                if (in_array($action, array_keys($this->template->actionsHidden))) {
                    $actionConfig['hidden'] = true;
                } else {
                    $actionConfig['hidden'] = false;
                }

                $collector[$action] = $actionConfig;

                return $collector;
            }, []);
    }

    private function appendConfigParams()
    {
        if (!property_exists($this->template, 'authorize')) {
            $this->template->authorize = config('enso.forms.authorize');
        }

        if (!property_exists($this->template, 'dividerTitlePlacement')) {
            $this->template->dividerTitlePlacement = config('enso.forms.dividerTitlePlacement');
        }
    }

    private function isForbidden($route)
    {
        if (empty(request()->user())) {
            return $this->template->authorize;
        }
        return $this->template->authorize && !request()->user()->can('access-route', $route);
    }
}
