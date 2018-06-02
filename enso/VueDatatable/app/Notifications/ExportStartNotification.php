<?php

namespace LaravelEnso\VueDatatable\app\Notifications;

use App\Events\TesteEvent;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ExportStartNotification extends Notification
{
    use Queueable;

    public function __construct($name = '')
    {
        $this->name = isset($name) ? $name : 'table';
    }

    public function via($notifiable)
    {
        return config('enso.datatable.export.notifications');
    }

    public function toBroadcast($notifiable)
    {
        return new TesteEvent();
    }

    public function toDatabase($notifiable)
    {
        return [
            'body' => __('Export started').': '.__($this->name).' '.__('Table'),
            'link' => '#',
        ];
    }
}
