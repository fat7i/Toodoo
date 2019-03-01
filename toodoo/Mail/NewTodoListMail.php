<?php

namespace Toodoo\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Toodoo\Models\TodoList;

class NewTodoListMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * @var TodoList
     */
    public $todoList;

    /**
     * NewTodoListMail constructor.
     * @param TodoList $todoList
     */
    public function __construct(TodoList $todoList)
    {
        $this->todoList = $todoList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('toodoo_views::emails.new-todo-list')->subject('New TODO List!');
    }
}
