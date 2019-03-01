<?php

namespace Toodoo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Mixed_;

class Item extends Model
{

    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'items';

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'completed',
        'list_id',
    ];

    /**
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'list_id' => 'required',
    ];

    /**
     * @var array
     */
    protected $hidden = ['todo_list_id', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function todoList()
    {
        return $this->belongsTo('Toodoo\Models\TodoList');
    }

    /**
     * @param int $todo_list_id
     * @param string $title
     * @param int $completed
     * @return Item
     */
    public function create(int $todo_list_id, string $title, int $completed): Item
    {
        $item = new static();
        $item->todo_list_id = $todo_list_id;
        $item->title = $title;
        $item->completed = $completed;
        $item->save();

        return $item->load('todoList');
    }

    /**
     * @param int $id
     * @param string $title
     * @param int $completed
     * @return Item
     */
    public function updateOne(int $id, string $title, int $completed): Item
    {
        $item = self::find($id);
        $item->title = $title;
        $item->completed = $completed;
        $item->save();

        return $item->load('todoList');
    }

    /**
     * @param int $todo_list_id
     * @param int $completed
     * @return mixed
     */
    public function updateMultiStatus(int $todo_list_id, int $completed)
    {
        return self::where('todo_list_id', $todo_list_id)
            ->update(['completed' => $completed]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id)
    {
        return self::where('id', $id)->first()->delete();
    }

    /**
     * @param int $todo_list_id
     * @return mixed
     */
    public function deleteCompletedItems(int $todo_list_id)
    {
        return self::where('todo_list_id', $todo_list_id)->where('completed', 1)->delete();
    }
}
