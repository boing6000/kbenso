<?php
/**
 * Created by PhpStorm.
 * User: boing
 * Date: 31/07/2018
 * Time: 08:49
 */

namespace LaravelEnso\FormBuilder\app\Classes;

use Illuminate\Database\Eloquent\Model;

class KBuilder
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
        $this->appendConfigParams()
            ->setValues()
            ->computeActions();

        unset($this->template->routes, $this->template->routePrefix, $this->template->authorize);
    }

    private function setValues()
    {
        if (!$this->model) {
            return $this;
        }

        collect($this->template->sections)->each(function ($section) {
            collect($section->fields)->each(function ($field) {
                /*
                 * checks if multiple
                 */
                if ($field->meta->type == 'select'
                    && property_exists($field->meta, 'multiple')
                    && $field->meta->multiple
                    && $this->checkArrayIsObject($this->model->{$field->name})
                ) {
                    $field->value = $this->model->{$field->name}->map(function ($model) use ($field) {
                        $trackBy = property_exists($field->meta, 'trackBy') ? $field->meta->trackBy : 'id';
                        return $model->{$trackBy};
                    });
                } else if($field->meta->type == 'datepicker' && is_object($this->model->{$field->name})){
                    $field->value = $this->model->{$field->name}->format($field->meta->format);
                } else {
                    $field->value = $this->model->{$field->name};
                }
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
                    : ['path', route($route, is_null($this->model) ? [] : [$this->model->getKey()], false)];

                $actionConfig[$routeOrPath] = $value;

                if ($action === 'show') {
                    $actionConfig['id'] = $this->model->getKey();
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

        return $this;
    }

    private function isForbidden($route)
    {
        if (empty(request()->user())) {
            return $this->template->authorize;
        }
        return $this->template->authorize
            && request()->user()
                ->cannot('access-route', $route);
    }

    private function checkArrayIsObject($array) {
        foreach ($array as $item) {
            if(is_object($item)){
                return true;
            }
        }
        return false;
    }
}