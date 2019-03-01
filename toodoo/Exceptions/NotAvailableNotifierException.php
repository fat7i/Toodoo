<?php

namespace Toodoo\Exceptions;

class NotAvailableNotifierException extends \Exception
{
    protected $message = 'No notifier available for this type';
}
