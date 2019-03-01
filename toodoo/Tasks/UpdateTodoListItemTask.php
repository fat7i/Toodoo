<?php

namespace Toodoo\Tasks;

use Toodoo\Repositories\ItemRepository;

class UpdateTodoListItemTask implements TaskInterface
{
    /**
     * @var ItemRepository
     */
    private $itemRepository;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var int
     */
    private $completed;

    /**
     * UpdateTodoListItemTask constructor.
     * @param ItemRepository $itemRepository
     */
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @return mixed|\Toodoo\Models\Item
     */
    public function run()
    {
        return $this->itemRepository->update($this->id, $this->title, $this->completed);
    }

    /**
     * @param int $id
     * @return UpdateTodoListItemTask
     */
    public function setId(int $id): UpdateTodoListItemTask
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $title
     * @return UpdateTodoListItemTask
     */
    public function setTitle(string $title): UpdateTodoListItemTask
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param int $completed
     * @return UpdateTodoListItemTask
     */
    public function setCompleted(int $completed): UpdateTodoListItemTask
    {
        $this->completed = $completed;
        return $this;
    }
}
