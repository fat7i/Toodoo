<?php

namespace Toodoo\Repositories;

use Toodoo\Models\TodoList;

class TodoListRepository
{
    /**
     * @var TodoList
     */
    private $model;

    /**
     * TodoListRepository constructor.
     * @param TodoList $todoList
     */
    public function __construct(TodoList $todoList)
    {
        $this->model = $todoList;
    }

    /**
     * @param string $name
     * @param array $participants
     * @return TodoList
     */
    public function create(string $name, array $participants): TodoList
    {
        return $this->model->create($name, $participants);
    }

    /**
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function getOneByKeyValue(string $key, string $value)
    {
        return $this->model->getOneByKeyValue($key, $value);
    }

    /**
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function deleteByKeyValue(string $key, string $value)
    {
        return $this->model->deleteByKeyValue($key, $value);
    }

    /**
     * @param string $uuid
     * @return int
     */
    public function getIdByUuid(string $uuid): ?int
    {
        return $this->model->getIdByUuid($uuid);
    }
}
