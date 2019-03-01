<?php

namespace Toodoo\Exceptions;

class CreateTodoListFailedException extends \Exception
{
    protected $message = 'Failed to create todo list';
}
