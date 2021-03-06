<?php

namespace LaravelEnso\VueDatatable\app\Classes\Attributes;

class Button
{
    const Mandatory = ['type', 'icon', 'class'];

    const Optional = ['routeSuffix', 'action', 'fullRoute', 'label', 'method', 'confirmation', 'event', 'message', 'params', 'postEvent', 'disabled'];

    const Actions = ['router', 'href', 'ajax', 'export'];

    const Methods = ['GET', 'PUT', 'PATCH', 'POST', 'DELETE'];
}
