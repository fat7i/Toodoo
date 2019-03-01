<?php

namespace Toodoo\Tasks;

use Toodoo\Repositories\ItemRepository;

class DeleteTodoListItemTask implements TaskInterface
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
     * UpdateTodoListItemTask constructor.
     * @param ItemRepository $itemRepository
     */
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function run()
    {
        return $this->itemRepository->delete($this->id);
    }

    /**
     * @param int $id
     * @return DeleteTodoListItemTask
     */
    public function setId(int $id): DeleteTodoListItemTask
    {
        $this->id = $id;
        return $this;
    }
}
