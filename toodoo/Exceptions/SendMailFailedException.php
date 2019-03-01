<?php

namespace Toodoo\Exceptions;

class SendMailFailedException extends \Exception
{
    protected $message = 'Failed to send mail';
}