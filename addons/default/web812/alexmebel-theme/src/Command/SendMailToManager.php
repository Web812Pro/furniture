<?php namespace Web812\AlexmebelTheme\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Web812\AlexmebelTheme\Notification\RequestFromSite;

class SendMailToManager
{

    /**
     * Request object
     *
     * @var array
     */
    protected $request;

    /**
     * Create SendMailToManagers instance
     *
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the command
     *
     * @param RoleRepositoryInterface $roles
     */
    public function handle(
        RoleRepositoryInterface $roles,
        SettingRepositoryInterface $settings
    )
    {
        $roleSlug = $settings->value('web812.theme.alexmebel::notifiable_role');

        if ($role = $roles->findBySlug($roleSlug))
        {
            $role->getUsers()->each(
                /* @var UserModel $user */
                function ($user)
                {
                    $user->notify(new RequestFromSite($this->request));
                }
            );
        }
    }
}
