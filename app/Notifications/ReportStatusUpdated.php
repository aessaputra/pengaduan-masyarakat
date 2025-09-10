<?php

namespace App\Notifications;

use App\Models\ReportStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportStatusUpdated extends Notification
{
    use Queueable;

    protected $reportStatus;

    /**
     * Create a new notification instance.
     */
    public function __construct(ReportStatus $reportStatus)
    {
        $this->reportStatus = $reportStatus;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'report_id' => $this->reportStatus->report->id,
            'report_code' => $this->reportStatus->report->code,
            'report_title' => $this->reportStatus->report->title,
            'status' => $this->reportStatus->status,
        ];
    }
}
