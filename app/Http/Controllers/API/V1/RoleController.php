<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $roles = Role::all();
        return $this->sendResponse($roles->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'slug' => 'required']);
        $role = Role::create($request->all());
        return $this->sendResponse($role->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $role = Role::find($id);
        return $this->sendResponse($role->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        dd($request->all());
        $request->validate(['name' => 'required', 'slug' => 'required']);
        $role = Role::findOrFail($id);

        return $this->sendResponse($role->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return $this->sendResponse(array(), 'suppression avec success');
    }
}
