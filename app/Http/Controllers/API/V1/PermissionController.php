<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $permission = Permission::all();
        return $this->sendResponse($permission->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'slug' => 'required']);
        $permission = Permission::create($request->all());
        return $this->sendResponse($permission->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param Permission $permission
     * @return Response
     */
    public function show(Permission $permission)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Permission $permission
     * @return Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Permission $permission
     * @return Response
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
