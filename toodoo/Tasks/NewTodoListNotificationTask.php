<?php

namespace Toodoo\Tasks;

use Toodoo\Notifiers\NotifierInterface;

class NewTodoListNotificationTask implements TaskInterface
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
     * @return mixed
     */
    public function run()
    {
        return $this->notifier
                ->setContentObject($this->contentObject)
                ->setReceptorsObject($this->contentObject->participants)
                ->setTemplate($this->template)
                ->send();
    }

    /**
     * @param NotifierInterface $notifier
     * @return NewTodoListNotificationTask
     */
    public function setNotifier(NotifierInterface $notifier): NewTodoListNotificationTask
    {
        $this->notifier = $notifier;
        return $this;
    }

    /**
     * @param $contentObject
     * @return NewTodoListNotificationTask
     */
    public function setContentObject($contentObject): NewTodoListNotificationTask
    {
        $this->contentObject = $contentObject;
        return $this;
    }

    /**
     * @param string $template
     * @return NewTodoListNotificationTask
     */
    public function setTemplate(string $template): NewTodoListNotificationTask
    {
        $this->template = $template;
        return $this;
    }
}
