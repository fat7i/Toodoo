<?php

namespace Toodoo\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Toodoo\Helpers\Helper;

class TodoList extends Model
{

    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'todo_lists';

    /**
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
    ];

    /**
     * @var array
     */
    public static $rules = [
        'uuid' => 'required|unique:lists',
        'name' => 'required',
    ];

    /**
     * @var array
     */
    protected $hidden = ['pivot', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany('Toodoo\Models\Item');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function participants()
    {
        return $this->belongsToMany('Toodoo\Models\Participant')->select(['id', 'email']);
    }

    /**
     * @param string $name
     * @param array $participants
     * @return TodoList
     */
    public function create(string $name, array $participants): TodoList
    {
        $todoList = new static();
        $todoList->uuid = Helper::uuid();
        $todoList->name = $name;
        $todoList->save();


        $participantsArray = [];

        foreach ($participants as $participant) {
            $participantsArray[] = Participant::firstOrCreate(['email' => $participant]);
        }

        $todoList->participants()->saveMany(array_unique($participantsArray));

        return $todoList->load('participants');
    }

    /**
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function getOneByKeyValue(string $key, string $value)
    {
        return self::where($key, $value)->with('items')->with('participants')->first();
    }

    /**
     * @param string $key
     * @param string $value
     * @return mixed
     */
    public function deleteByKeyValue(string $key, string $value)
    {
        self::where($key, $value)->first()->items()->delete();
        return self::where($key, $value)->first()->delete();
    }

    /**
     * @param string $uuid
     * @return int
     */
    public function getIdByUuid(string $uuid): ?int
    {
        return self::where('uuid', $uuid)->value('id');
    }
}
