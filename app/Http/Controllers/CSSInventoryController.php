<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\CSSItem;

class CSSInventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = CSSItem::where('id', '!=', 0)
               ->orderBy('updated_at', 'desc')
               // ->take(10)
               ->get();

        return view('admin.css', ['items' => $items]);
    }

    /**
     * Display a listing of specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function filter(Request $request)
    // {
    //     $search = $request->search;
    //     $type   = $request->type;
    //     $status = $request->status;

    //     $query = CSSItem::select('*');

    //     if ($search == "") {
    //         if ($type == "") {
    //             if ($status == "") {
    //                 $items = CSSItem::where('id', '!=', 0)
    //                 ->orderBy('updated_at', 'desc')
    //                 // ->take(10)
    //                 ->get();
    //             } else {
    //                 $items = CSSItem::where('id', '!=', 0)
    //                 ->where('item_status',$status)
    //                 ->orderBy('updated_at', 'desc')
    //                 // ->take(10)
    //                 ->get();
    //             }
                
    //         } else {
    //             $items = CSSItem::where('id', '!=', 0)
    //             ->where('item_type',$type)
    //             ->orderBy('updated_at', 'desc')
    //             // ->take(10)
    //             ->get();
    //         }
            
            
    //     } else {
    //         $items = CSSItem::where('item_name','LIKE',"%{$search}%")
    //             ->orWhere('item_quantity','LIKE',"%{$search}%")
    //             ->orWhere('item_type','LIKE',"%{$search}%")
    //             ->orWhere('item_status','LIKE',"%{$search}%")
    //             ->orderBy('updated_at', 'desc')
    //             ->get();
    //     }

    //     return response()->json([
    //         'message'  => 'Fetched successfully.',
    //         'code'     => '200',
    //         'items'     => $items
    //     ], 200);
    // }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add_css');
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
            'item_name' => 'required|unique:c_s_s_items',
            'item_quantity' => 'required',
            'item_type' => 'required',
            'item_status' => 'required',
            'expired_at' => 'nullable'
        ]);

        if ($validator->passes()) {
            CSSItem::create($request->all());

            return response()->json([
                'success' => 'Added new item. Redirecting to CSS Inventory.',
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
        $item = CSSItem::where('id', $id)->first();
        return view('admin.edit_css', ['item' => $item]);
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
            'item_name' => 'required|unique:c_s_s_items,item_name,'.$id.',id',
            'item_quantity' => 'required',
            'item_type' => 'required',
            'item_status' => 'required'
        ]);

        if ($validator->passes()) {
            CSSItem::find($id)
            ->update($request->all());

            // activity()->log('You have updated css item');

            return response()->json([
                'success' => 'Updated item. Redirecting to CSS Inventory.',
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
        $item = CSSItem::find($id);
        $item->delete();

        return response()->json([
            'message' => 'Deleted item id: '.$id,
            'code'    => '200'
        ], 200);
    }
}
