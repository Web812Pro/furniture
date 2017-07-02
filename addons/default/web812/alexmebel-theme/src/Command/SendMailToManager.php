<?php namespace Web812\AlexmebelTheme\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\UsersModule\Role\Contract\RoleRepositoryInterface;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Web812\AlexmebelTheme\Notification\RequestFromSite;

class SendMailToManager
{

    /**
     * Data object
     *
     * @var array
     */
    protected $data;

    /**
     * Create SendMailToManagers instance
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
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
        /* @var RoleInterface $user */
        if ($role = $roles->find($settings->value('web812.theme.alexmebel::config.notifiable_role', 1)))
        {
            $role->getUsers()->each(
                /* @var UserInterface $user */
                function (UserInterface $user)
                {
                    $user->notify(new RequestFromSite($this->data));
                }
            );

            return true;
        }

        return $roleId;
    }
}
