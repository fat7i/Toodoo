<?php

namespace Toodoo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toodoo\Services\NotificationService;
use Toodoo\Services\TodoListService;

class TodoListController extends Controller
{
    /**
     * @var TodoListService
     */
    private $todoListService;

    /**
     * @var NotificationService
     */
    private $notificationService;

    /**
     * TodoListController constructor.
     * @param TodoListService $todoListService
     * @param NotificationService $notificationService
     */
    public function __construct(TodoListService $todoListService, NotificationService $notificationService)
    {
        $this->todoListService = $todoListService;
        $this->notificationService = $notificationService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Toodoo\Exceptions\CreateTodoListFailedException
     * @throws \Toodoo\Exceptions\NotAvailableNotifierException
     */
    public function store(Request $request)
    {
        //TODO implement custom validation for participants emails
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'participants' => 'required|array',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $todoList = $this->todoListService
            ->create($request->get('name'), $request->get('participants'));


        $this->notificationService
                ->setNotifier('mail')
                ->setContentObject($todoList)
                ->setTemplate('NewTodoList')
                ->send();

        return response()->json($todoList, 201);
    }

    /**
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($uuid)
    {
        $todoList = $this->todoListService->getOne($uuid);

        if ($todoList) {
            return response()->json($todoList->items, 200);
        }

        return response()->json(['error' => 'resource not found'], 404);
    }


    /**
     * @param $uuid
     * @return \Illuminate\Http\JsonResponse
     * @throws \Toodoo\Exceptions\NotAvailableNotifierException
     */
    public function destroy($uuid)
    {
        $todoList = $this->todoListService
            ->delete($uuid);

        if ($todoList) {
            $this->notificationService
                ->setNotifier('mail')
                ->setContentObject($todoList)
                ->setTemplate('DeleteTodoList')
                ->send();

            return response()->json(null, 204);
        }

        return response()->json(['error' => 'resource not found'], 404);
    }
}
