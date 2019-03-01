<?php

namespace Toodoo\Exceptions;

class NotAvailableMailTemplateException extends \Exception
{
    protected $message = 'No available mail template';
}
