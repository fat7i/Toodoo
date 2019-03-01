<?php

namespace Toodoo\Services;

use Toodoo\Tasks\CreateTodoListItemTask;
use Toodoo\Tasks\DeleteCompletedTodoListItemsTask;
use Toodoo\Tasks\DeleteTodoListItemTask;
use Toodoo\Tasks\UpdateTodoListItemsStatusTask;
use Toodoo\Tasks\UpdateTodoListItemTask;

class ItemService
{
    /**
     * @var CreateTodoListItemTask
     */
    private $createTodoListItemTask;

    /**
     * @var UpdateTodoListItemTask
     */
    private $updateTodoListItemTask;

    /**
     * @var UpdateTodoListItemsStatusTask
     */
    private $updateTodoListItemsStatusTask;

    /**
     * @var DeleteTodoListItemTask
     */
    private $deleteTodoListItemTask;

    /**
     * @var DeleteCompletedTodoListItemsTask
     */
    private $deleteCompletedTodoListItemsTask;

    /**
     * ItemService constructor.
     * @param CreateTodoListItemTask $createTodoListItemTask
     * @param UpdateTodoListItemTask $updateTodoListItemTask
     * @param UpdateTodoListItemsStatusTask $updateTodoListItemsStatusTask
     * @param DeleteTodoListItemTask $deleteTodoListItemTask
     * @param DeleteCompletedTodoListItemsTask $deleteCompletedTodoListItemsTask
     */
    public function __construct(
        CreateTodoListItemTask $createTodoListItemTask,
        UpdateTodoListItemTask $updateTodoListItemTask,
        UpdateTodoListItemsStatusTask $updateTodoListItemsStatusTask,
        DeleteTodoListItemTask $deleteTodoListItemTask,
        DeleteCompletedTodoListItemsTask $deleteCompletedTodoListItemsTask
    ) {
        $this->createTodoListItemTask = $createTodoListItemTask;
        $this->updateTodoListItemTask = $updateTodoListItemTask;
        $this->updateTodoListItemsStatusTask = $updateTodoListItemsStatusTask;
        $this->deleteTodoListItemTask = $deleteTodoListItemTask;
        $this->deleteCompletedTodoListItemsTask = $deleteCompletedTodoListItemsTask;
    }

    /**
     * @param string $uuid
     * @param string $title
     * @param int $completed
     * @return mixed|\Toodoo\Models\Item
     */
    public function create(string $uuid, string $title, int $completed)
    {
        return $this->createTodoListItemTask
            ->setTodoListId($uuid)
            ->setTitle($title)
            ->setCompleted($completed)
            ->run();
    }

    /**
     * @param int $id
     * @param string $title
     * @param int $completed
     * @return mixed|\Toodoo\Models\Item
     */
    public function update(int $id, string $title, int $completed)
    {
        return $this->updateTodoListItemTask
            ->setId($id)
            ->setTitle($title)
            ->setCompleted($completed)
            ->run();
    }

    /**
     * @param string $uuid
     * @param int $completed
     * @return mixed|\Toodoo\Models\Item
     */
    public function updateMultiStatus(string $uuid, int $completed)
    {
        return $this->updateTodoListItemsStatusTask
            ->setTodoListId($uuid)
            ->setCompleted($completed)
            ->run();
    }

    /**
     * @param int $id
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete(int $id)
    {
        return $this->deleteTodoListItemTask
            ->setId($id)
            ->run();
    }

    /**
     * @param string $uuid
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function deleteCompleted(string $uuid)
    {
        return $this->deleteCompletedTodoListItemsTask
            ->setTodoListId($uuid)
            ->run();
    }
}
