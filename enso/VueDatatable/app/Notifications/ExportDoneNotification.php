<?php

namespace LaravelEnso\VueDatatable\app\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ExportDoneNotification extends Notification
{
    use Queueable;

    public $file;

    public function __construct(string $file, $name)
    {
        $this->file = $file;
        $this->name = $name;
    }

    public function via($notifiable)
    {
        return array_merge(['mail'], config('enso.datatable.export.notifications'));
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'level' => 'success',
            'body' => __('Export emailed').': '.__($this->name).' '.__('Table'),
        ]);
    }

    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(__('Export Notification'))
            ->line(__('You will find attached the requested report.'))
            ->line(__('Thank you for using our application!'))
            ->attach($this->file);
    }

    public function toArray($notifiable)
    {
        return [
            'body' => __('Export emailed').': '.__($this->name).' '.__('Table'),
            'link' => '#',
        ];
    }
}
