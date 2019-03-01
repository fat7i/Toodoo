<?php

namespace Toodoo\Repositories;

use Toodoo\Models\Item;

class ItemRepository
{
    /**
     * @var Item
     */
    private $model;

    /**
     * ParticipantRepository constructor.
     * @param Item $item
     */
    public function __construct(Item $item)
    {
        $this->model = $item;
    }

    /**
     * @param int $todo_list_id
     * @param string $title
     * @param int $completed
     * @return Item
     */
    public function create(int $todo_list_id, string $title, int $completed): Item
    {
        return $this->model->create($todo_list_id, $title, $completed);
    }

    /**
     * @param int $id
     * @param string $title
     * @param int $completed
     * @return Item
     */
    public function update(int $id, string $title, int $completed): Item
    {
        return $this->model->updateOne($id, $title, $completed);
    }

    /**
     * @param int $todo_list_id
     * @param int $completed
     * @return mixed
     */
    public function updateMultiStatus(int $todo_list_id, int $completed)
    {
        return $this->model->updateMultiStatus($todo_list_id, $completed);
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public function delete(int $id)
    {
        return $this->model->deleteById($id);
    }

    /**
     * @param int $todo_list_id
     * @return mixed
     */
    public function deleteCompletedItems(int $todo_list_id)
    {
        return $this->model->deleteCompletedItems($todo_list_id);
    }
}
