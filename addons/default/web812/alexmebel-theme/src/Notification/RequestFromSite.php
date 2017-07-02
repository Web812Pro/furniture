<?php namespace Web812\AlexmebelTheme\Notification;

<<<<<<< HEAD
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Anomaly\Streams\Platform\Notification\Message\MailMessage;

class RequestFromSite extends Notification implements ShouldQueue
{

=======
use Anomaly\Streams\Platform\Notification\Message\MailMessage;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class RequestFromSite extends Notification implements ShouldQueue
{
>>>>>>> ba09c4505b8dd1be4bd2e1aa106158bf3d22bccb
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
<<<<<<< HEAD
        ->view('web812.theme.alexmebel::notifications.request')
        ->subject(trans('web812.theme.alexmebel::notification.request.subject', $data))
        ->greeting(trans('web812.theme.alexmebel::notification.request.greeting', $data))
        ->line(trans('web812.theme.alexmebel::notification.request.instructions', $data));
=======
            ->view('web812.theme.alexmebel::notifications.request', [
                'phone' => $this->request->get('phone'),
            ])
            ->subject(trans('web812.theme.alexmebel::notification.request.subject', $data))
            ->greeting(trans('web812.theme.alexmebel::notification.request.greeting', $data))
            ->line(trans('web812.theme.alexmebel::notification.request.instructions', $data));
    }
>>>>>>> ba09c4505b8dd1be4bd2e1aa106158bf3d22bccb
}
