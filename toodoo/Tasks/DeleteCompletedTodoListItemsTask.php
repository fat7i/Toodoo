<?php

namespace Toodoo\Tasks;

use Toodoo\Repositories\ItemRepository;
use Toodoo\Repositories\TodoListRepository;

class DeleteCompletedTodoListItemsTask implements TaskInterface
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
     * UpdateTodoListItemTask constructor.
     * @param ItemRepository $itemRepository
     * @param TodoListRepository $todoListRepository
     */
    public function __construct(ItemRepository $itemRepository, TodoListRepository $todoListRepository)
    {
        $this->itemRepository = $itemRepository;
        $this->todoListRepository = $todoListRepository;
    }

    /**
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function run()
    {
        return $this->itemRepository->deleteCompletedItems($this->todo_list_id);
    }

    /**
     * @param string $uuid
     * @return DeleteCompletedTodoListItemsTask
     */
    public function setTodoListId(string $uuid): DeleteCompletedTodoListItemsTask
    {
        $this->todo_list_id = $this->todoListRepository->getIdByUuid($uuid);
        return $this;
    }
}
