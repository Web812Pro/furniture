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
     * Request data.
     *
     * @var array
     */
    public $data;

    /**
     * Create a new NewRequest instance.
     *
     * @param $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
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
        return (new MailMessage())
            ->view(
                'web812.theme.alexmebel::notifications.request',
                $this->data
            )
            ->subject(
                trans(
                    'web812.theme.alexmebel::notification.request.subject',
                    $notifiable->toArray()
                )
            );
    }
}
