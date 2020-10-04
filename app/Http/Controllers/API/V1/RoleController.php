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
        $roles = array();
        $rolesCollections = Role::all();
        foreach ($rolesCollections as $rolesCollection) {
            $rolesColAR = $rolesCollection->toArray();
            $rolesColAR['permissions'] = $rolesCollection->permissions()->allRelatedIds();
            array_push($roles, $rolesColAR);
        }
        return $this->sendResponse($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        $role = Role::create($request->all());
        return $this->sendResponse($role->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return JsonResponse
     */
    public function show(Role $role)
    {
        return $this->sendResponse($role->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(Request $request, Role $role)
    {
        dd($request->all());
        $request->validate(['name' => 'required', 'slug' => 'required']);
        $role = Role::findOrFail($id);

        return $this->sendResponse($role->toArray());
    }

    public function filter(Request $request)
    {
        $roles = array();

        $rolesCollections = Role::all();
        foreach ($rolesCollections as $rolesCollection) {
            $rolesColAR = $rolesCollection->toArray();
            $rolesColAR['permissions'] = $rolesCollection->permissions()->allRelatedIds();
            array_push($roles, $rolesColAR);
        }
        return $this->sendResponse($roles);
    }

    public function userHasRole(Role $role)
    {

        return $this->sendResponse($role->users()->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return $this->sendResponse(array(), 'Suppression avec success');
    }


    public function hisPermissions(Role $role)
    {
        return $this->sendResponse($role->permissions()->get()->toArray());
    }
}
