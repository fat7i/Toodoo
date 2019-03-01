<?php

Route::middleware('api', 'throttle:60,1')->prefix('api.php/lists')->group(function () {


    // 1- Create To do List
    // POST - `api.php/lists`
    Route::post('/', 'Toodoo\Controllers\TodoListController@store');

    // 2- Delete To do List
    // DELETE - `api.php/lists/:list-id`
    Route::delete('/{uuid}', 'Toodoo\Controllers\TodoListController@destroy');

    // 3- Read To do List Items
    // GET - `api.php/lists/:list-id/todos`
    Route::get('/{uuid}/todos', 'Toodoo\Controllers\TodoListController@show');



    // 4- Create To do Item
    // POST - api.php/lists/:list-id/todos
    Route::post('/{list_id}/todos', 'Toodoo\Controllers\ItemController@store');

    // 5- Update To do Item
    // PUT - api.php/lists/:list-id/todos/:item-id
    Route::put('/{list_id}/todos/{id}', 'Toodoo\Controllers\ItemController@update');

    // 6- Mark Multiple To do Items As Completed/Pending
    // PATCH - api.php/lists/:list-id/todos
    Route::patch('/{list_id}/todos', 'Toodoo\Controllers\ItemController@updates');

    // 7- Delete To do Item
    // DELETE - api.php/lists/:list-id/todos/:item-id
    Route::delete('/{list_id}/todos/{id}', 'Toodoo\Controllers\ItemController@delete');

    // 8- Delete Completed To do Items
    // DELETE - api.php/lists/:list-id/todos?completed
    Route::delete('/{list_id}/{completed}', 'Toodoo\Controllers\ItemController@destroy');

});

