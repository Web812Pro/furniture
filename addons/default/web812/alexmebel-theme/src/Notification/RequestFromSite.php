<?php namespace Web812\AlexmebelTheme\Notification;

use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

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
            ->view('web812.theme.alexmebel::notifications.request', [
                'phone' => array_get($this->request, 'phone'),
            ])
            ->subject(trans('web812.theme.alexmebel::notification.request.subject', $data))
            ->greeting(trans('web812.theme.alexmebel::notification.request.greeting', $data))
            ->line(trans('web812.theme.alexmebel::notification.request.instructions', $data));
    }
}
