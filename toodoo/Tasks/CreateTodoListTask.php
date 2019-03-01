<?php

namespace Toodoo\Tasks;

use Toodoo\Repositories\TodoListRepository;

class CreateTodoListTask implements TaskInterface
{
    /**
     * @var TodoListRepository
     */
    private $todoListRepository;

    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $participants;

    /**
     * CreateTodoListTask constructor.
     * @param TodoListRepository $todoListRepository
     */
    public function __construct(TodoListRepository $todoListRepository)
    {
        $this->todoListRepository = $todoListRepository;
    }

    /**
     * @return mixed|\Toodoo\Models\TodoList
     */
    public function run()
    {
        return $this->todoListRepository->create($this->name, $this->participants);
    }

    /**
     * @param string $name
     * @return CreateTodoListTask
     */
    public function setName(string $name): CreateTodoListTask
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param array $participants
     * @return CreateTodoListTask
     */
    public function setParticipants(array $participants): CreateTodoListTask
    {
        $this->participants = $participants;
        return $this;
    }
}
