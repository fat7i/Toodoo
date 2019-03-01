<?php

namespace Toodoo\Tasks;

use Toodoo\Repositories\TodoListRepository;

class DeleteTodoListTask implements TaskInterface
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
     * DeleteTodoListTask constructor.
     * @param TodoListRepository $todoListRepository
     */
    public function __construct(TodoListRepository $todoListRepository)
    {
        $this->todoListRepository = $todoListRepository;
    }

    /**
     * @return mixed
     */
    public function run()
    {
        return $this->todoListRepository->deleteByKeyValue($this->key, $this->value);
    }

    /**
     * @param string $key
     * @param string $value
     * @return DeleteTodoListTask
     */
    public function setWhere(string $key, string $value): DeleteTodoListTask
    {
        $this->key = $key;
        $this->value = $value;
        return $this;
    }
}
