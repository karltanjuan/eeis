<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\EPASItem;

class EPASInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = EPASItem::where('id', '!=', 0)
               ->orderBy('updated_at', 'desc')
               // ->take(10)
               ->get();

        return view('admin.epas', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_epas');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->expired_at == null) {
            $request->request->add(['expired_at' => '0000-00-00']);
        }

        $validator = Validator::make($request->all(), [ 
            'item_name' => 'required|unique:epas_items',
            'item_quantity' => 'required',
            'item_type' => 'required',
            'item_status' => 'required',
            'expired_at' => 'nullable'
        ]);

        if ($validator->passes()) {
            EPASItem::create($request->all());

            return response()->json([
                'success' => 'Added new item. Redirecting to EPAS Inventory.',
                'code'    => '200'
            ], 200);
        }

        return response()->json([
            'error' => $validator->errors()->all(),
            'code' => '422'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = EPASItem::where('id', $id)->first();
        return view('admin.edit_epas', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ 
            'item_name' => 'required|unique:epas_items,item_name,'.$id.',id',
            'item_quantity' => 'required',
            'item_type' => 'required',
            'item_status' => 'required'
        ]);

        if ($validator->passes()) {
            EPASItem::find($id)
            ->update($request->all());

            return response()->json([
                'success' => 'Updated item. Redirecting to EPAS Inventory.',
                'code'    => '200'
            ], 200);
        }

        return response()->json([
            'error' => $validator->errors()->all(),
            'code' => '422'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = EPASItem::find($id);
        $item->delete();

        return response()->json([
            'message' => 'Deleted item id: '.$id,
            'code'    => '200'
        ], 200);
    }
}
