<?php

namespace Toodoo\Notifiers;

interface NotifierInterface
{
    public function setContentObject($contentObject);

    public function setReceptorsObject($receptorsObject);

    public function setTemplate(string $templateName);

    public function send();
}
