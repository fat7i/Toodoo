<?php

namespace Toodoo\Services;

use Toodoo\Exceptions\CreateTodoListFailedException;
use Toodoo\Tasks\CreateTodoListTask;
use Toodoo\Tasks\DeleteTodoListTask;
use Toodoo\Tasks\GetTodoListTask;

class TodoListService
{

    /**
     * @var CreateTodoListTask
     */
    private $createTodoListTask;

    /**
     * @var DeleteTodoListTask
     */
    private $deleteTodoListTask;

    /**
     * @var GetTodoListTask
     */
    private $getTodoListTask;

    /**
     * TodoListService constructor.
     * @param CreateTodoListTask $createTodoListTask
     * @param DeleteTodoListTask $deleteTodoListTask
     * @param GetTodoListTask $getTodoListTask
     */
    public function __construct(
        CreateTodoListTask $createTodoListTask,
        DeleteTodoListTask $deleteTodoListTask,
        GetTodoListTask $getTodoListTask
    ) {

        $this->createTodoListTask = $createTodoListTask;
        $this->deleteTodoListTask = $deleteTodoListTask;
        $this->getTodoListTask = $getTodoListTask;
    }

    /**
     * @param string $name
     * @param array $participants
     * @return mixed|\Toodoo\Models\TodoList
     * @throws CreateTodoListFailedException
     */
    public function create(string $name, array $participants)
    {
        try {
            return $this->createTodoListTask
                ->setName($name)
                ->setParticipants($participants)
                ->run();
        } catch (\Exception $exception) {
            throw new CreateTodoListFailedException();
        }
    }

    /**
     * @param string $uuid
     * @return bool|mixed|\Toodoo\Models\TodoList
     */
    public function delete(string $uuid)
    {
        $todoList = $this->getTodoListTask->setWhere('uuid', $uuid)->run();

        if (!$todoList) {
            return false;
        }

        $isDeleted = $this->deleteTodoListTask->setWhere('uuid', $uuid)->run();

        if ($isDeleted) {
            return $todoList;
        }

        return false;
    }

    /**
     * @param string $uuid
     * @return mixed|\Toodoo\Models\TodoList
     */
    public function getOne(string $uuid)
    {
        return $this->getTodoListTask->setWhere('uuid', $uuid)->run();
    }
}
