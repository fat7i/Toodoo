<?php

namespace Toodoo\Tasks;

use Toodoo\Repositories\ItemRepository;
use Toodoo\Repositories\TodoListRepository;

class UpdateTodoListItemsStatusTask implements TaskInterface
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
        return $this->itemRepository->updateMultiStatus($this->todo_list_id, $this->completed);
    }

    /**
     * @param string $uuid
     * @return UpdateTodoListItemsStatusTask
     */
    public function setTodoListId(string $uuid): UpdateTodoListItemsStatusTask
    {
        $this->todo_list_id = $this->todoListRepository->getIdByUuid($uuid);
        return $this;
    }

    /**
     * @param int $completed
     * @return UpdateTodoListItemsStatusTask
     */
    public function setCompleted(int $completed): UpdateTodoListItemsStatusTask
    {
        $this->completed = $completed;
        return $this;
    }
}
