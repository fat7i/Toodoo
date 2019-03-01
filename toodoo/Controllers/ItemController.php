<?php

namespace Toodoo\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Toodoo\Services\ItemService;

class ItemController extends Controller
{

    /**
     * @var ItemService
     */
    private $itemService;

    /**
     * ItemController constructor.
     * @param ItemService $itemService
     */
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $list_id)
    {
        $validator = Validator::make(['list_id' => $list_id, 'title' => $request->get('title')], [
            'list_id' => 'required|string|exists:todo_lists,uuid,deleted_at,NULL',
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $item = $this->itemService->create($list_id, $request->get('title'), $request->get('completed'));

        return response()->json($item, 201);
    }

    /**
     * @param Request $request
     * @param $list_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $list_id, $id)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int|exists:items,id,deleted_at,NULL',
            'title' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $item = $this->itemService->update($request->get('id'), $request->get('title'), $request->get('completed'));

        return response()->json($item, 200);
    }

    /**
     * @param Request $request
     * @param $list_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updates(Request $request, $list_id)
    {
        $validator = Validator::make($request->all(), [
            'completed' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $updatedItemsCount = $this->itemService->updateMultiStatus($list_id, $request->get('completed'));

        return response()->json(['success' => $updatedItemsCount. ' Items has been updated.'], 200);
    }

    /**
     * @param $list_id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function delete($list_id, $id)
    {
        $validator = Validator::make(['id' => $id], [
            'id' => 'required|exists:items,id,deleted_at,NULL'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $this->itemService->delete($id);

        return response()->json(null, 204);
    }

    /**
     * @param $list_id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($list_id)
    {
        $validator = Validator::make(['list_id' => $list_id], [
            'list_id' => 'required|string|exists:todo_lists,uuid,deleted_at,NULL',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $this->itemService->deleteCompleted($list_id);

        return response()->json(null, 204);
    }
}
