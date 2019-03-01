<?php

namespace Toodoo\Tasks;

use Toodoo\Repositories\TodoListRepository;

class GetTodoListTask implements TaskInterface
{
    /**
     * @var TodoListRepository
     */
    private $todoListRepository;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * GetTodoListTask constructor.
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
        return $this->todoListRepository->getOneByKeyValue($this->key, $this->value);
    }

    /**
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function setWhere(string $key, string $value)
    {
        $this->key = $key;
        $this->value = $value;
        return $this;
    }
}
