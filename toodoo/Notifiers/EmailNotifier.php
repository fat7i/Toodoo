<?php

namespace Toodoo\Notifiers;

use Illuminate\Support\Facades\Mail;
use Toodoo\Exceptions\NotAvailableMailTemplateException;
use Toodoo\Exceptions\SendMailFailedException;
use Toodoo\Mail\DeleteTodoListMail;
use Toodoo\Mail\NewTodoListMail;
use Toodoo\Models\TodoList;

class EmailNotifier implements NotifierInterface
{
    /**
     * @var TodoList
     */
    private $contentObject;

    /**
     * @var
     */
    private $receptorsObject;

    /**
     * @var string
     */
    private $template;

    /**
     * @param TodoList $contentObject
     * @return $this
     */
    public function setContentObject($contentObject)
    {
        $this->contentObject = $contentObject;
        return $this;
    }

    /**
     * @param $receptors
     * @return $this
     */
    public function setReceptorsObject($receptors)
    {
        $this->receptorsObject = $receptors;
        return $this;
    }

    /**
     * @return DeleteTodoListMail|NewTodoListMail
     * @throws NotAvailableMailTemplateException
     */
    public function getTemplate()
    {
        switch ($this->template) {
            case 'NewTodoList':
                return new NewTodoListMail($this->contentObject);
            case 'DeleteTodoList':
                return new DeleteTodoListMail($this->contentObject);
            default:
                throw new NotAvailableMailTemplateException();
        }
    }

    /**
     * @param string $template
     * @return $this
     */
    public function setTemplate(string $template)
    {
        $this->template = $template;
        return $this;
    }

    /**
     * @return mixed
     * @throws NotAvailableMailTemplateException
     */
    public function send()
    {
        //TODO add queue
        return Mail::to($this->receptorsObject)
            ->queue($this->getTemplate());
    }
}
