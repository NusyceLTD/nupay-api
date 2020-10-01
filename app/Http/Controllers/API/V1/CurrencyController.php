<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\API\BaseController;
use App\Models\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $currency = Currency::all();
        return $this->sendResponse($currency);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'symbol' => 'required',
            'code' => 'required',
            'is_cripto' => 'required',
        ]);
        $currency = Currency::create($request->all());
        return $this->sendResponse($currency->toArray(), '');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $currency = Currency::findOrFail($id);
        return $this->sendResponse($currency);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'symbol' => 'required',
            'code' => 'required',
            'is_cripto' => 'required',
        ]);
        $currency = Currency::update(array_merge($request->all(), array('id' => $id)));
        return $this->sendResponse($currency->toArray(), '');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $currency = Currency::find($id);
        $currency->delete();
        return $this->sendResponse(array(), 'Supprimé avec success');
    }
}
