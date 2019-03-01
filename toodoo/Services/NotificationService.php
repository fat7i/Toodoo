<?php

namespace Toodoo\Services;

use Toodoo\Exceptions\NotAvailableNotifierException;
use Toodoo\Notifiers\EmailNotifier;
use Toodoo\Notifiers\NotifierInterface;
use Toodoo\Tasks\NewTodoListNotificationTask;

class NotificationService
{
    /**
     * @var NotifierInterface
     */
    private $notifier;

    /**
     * @var
     */
    private $contentObject;

    /**
     * @var string
     */
    private $template;

    /**
     * @var NewTodoListNotificationTask
     */
    private $newTodoListNotificationTask;

    /**
     * NotificationService constructor.
     * @param NewTodoListNotificationTask $newTodoListNotificationTask
     */
    public function __construct(NewTodoListNotificationTask $newTodoListNotificationTask)
    {
        $this->newTodoListNotificationTask = $newTodoListNotificationTask;
    }

    /**
     * @param string $type
     * @return $this
     * @throws NotAvailableNotifierException
     */
    public function setNotifier(string $type): NotificationService
    {
        switch ($type) {
            case 'mail':
            case 'email':
                $this->notifier = new EmailNotifier();
                break;
            default:
                throw new NotAvailableNotifierException();
        }
        return $this;
    }

    /**
     * @param $contentObject
     * @return $this
     */
    public function setContentObject($contentObject): NotificationService
    {
        $this->contentObject = $contentObject;
        return $this;
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate(string $template): NotificationService
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     */
    public function send()
    {
        return $this->newTodoListNotificationTask
                ->setNotifier($this->notifier)
                ->setContentObject($this->contentObject)
                ->setTemplate($this->template)
                ->run();
    }
}
