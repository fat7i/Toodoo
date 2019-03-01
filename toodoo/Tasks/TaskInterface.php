<?php

namespace Toodoo\Tasks;

interface TaskInterface
{

    /**
     * Run the task
     * @return mixed
     */
    public function run();
}
