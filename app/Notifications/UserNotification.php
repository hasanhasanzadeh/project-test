<?php

namespace App\Notifications;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kavenegar\KavenegarApi;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected string $message;
    protected string $subject;
    protected string $type;
    /**
     * Create a new notification instance.
     */
    public function __construct($message, $subject = "Notification", $type = "all")
    {
        $this->message = $message;
        $this->subject = $subject;
        $this->type = $type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        $channels = [];

        if ($this->type === 'email' || $this->type === 'all') {
            $channels[] = 'mail';
        }
        if ($this->type === 'sms' || $this->type === 'all') {
            $channels[] = 'kavenegar';
        }

        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->subject)
            ->greeting("Hello, " . $notifiable->name)
            ->line($this->message)
            ->action('View Dashboard', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toKavenegar($notifiable)
    {
        if (!$notifiable->mobile) {
            return;
        }

        try {
            $api = new KavenegarApi(env('KAVENEGAR_API_KEY'));
            $api->Send("10008663", $notifiable->mobile, $this->message);
        } catch (Exception $e) {
            \Log::error("Kavenegar SMS Error: " . $e->getMessage());
        }
    }

    // Define how to route the notification for SMS
    public function routeNotificationForKavenegar($notifiable)
    {
        return $notifiable->mobile;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
