<?php

namespace Toodoo\Tasks;

use Toodoo\Repositories\ItemRepository;
use Toodoo\Repositories\TodoListRepository;

class CreateTodoListItemTask implements TaskInterface
{
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * @var TodoListRepository
     */
    private $todoListRepository;

    /**
     * @var int
     */
    private $todo_list_id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $completed;

    /**
     * CreateTodoListItemTask constructor.
     * @param ItemRepository $itemRepository
     * @param TodoListRepository $todoListRepository
     */
    public function __construct(ItemRepository $itemRepository, TodoListRepository $todoListRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->todoListRepository = $todoListRepository;
    }

    /**
     * @return mixed|\Toodoo\Models\Item
     */
    public function run()
    {
        return $this->itemRepository->create($this->todo_list_id, $this->title, $this->completed);
    }

    /**
     * @param string $uuid
     * @return CreateTodoListItemTask
     */
    public function setTodoListId(string $uuid): CreateTodoListItemTask
    {
        $this->todo_list_id = $this->todoListRepository->getIdByUuid($uuid);
        return $this;
    }

    /**
     * @param string $title
     * @return CreateTodoListItemTask
     */
    public function setTitle(string $title): CreateTodoListItemTask
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param int $completed
     * @return CreateTodoListItemTask
     */
    public function setCompleted(int $completed): CreateTodoListItemTask
    {
        $this->completed = $completed;
        return $this;
    }
}
