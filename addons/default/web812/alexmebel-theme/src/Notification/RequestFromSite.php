<?php namespace Web812\AlexmebelTheme\Notification;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\Streams\Platform\Notification\Message\MailMessage;

class RequestFromSite extends Notification implements ShouldQueue
{

    use Queueable;

    /**
     * Request request.
     *
     * @var array
     */
    public $request;

    /**
     * Create a new NewRequest instance.
     *
     * @param $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  UserInterface $notifiable
     * @return array
     */
    public function via(UserInterface $notifiable)
    {
        return ['mail'];
    }

    /**
     * Return the mail message.
     *
     * @param  UserInterface $notifiable
     * @return MailMessage
     */
    public function toMail(UserInterface $notifiable)
    {
        $data = $notifiable->toArray();

        return (new MailMessage())
        ->view('defr.module.apex::notifications.request_request')
        ->subject(trans('defr.module.apex::notification.request_request.subject', $data))
        ->greeting(trans('defr.module.apex::notification.request_request.greeting', $data))
        ->line(trans('defr.module.apex::notification.request_request.instructions', $data));
}