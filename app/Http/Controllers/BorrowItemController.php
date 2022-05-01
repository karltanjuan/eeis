<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BorrowItem;
use App\User;
use App\CSSItem;
use App\EPASItem;

class BorrowItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $css_borrows = BorrowItem::where('category', 'css')
               ->orderBy('created_at', 'asc')
               ->get();

        $epas_borrows = BorrowItem::where('category', 'epas')
               ->orderBy('created_at', 'asc')
               ->get();

        $new_css = [];
        $new_epas = [];

        foreach($css_borrows as $c_borrow) {
            $user = User::where('id',$c_borrow->user_id)->first();
            $css_item = CSSItem::where('id',$c_borrow->item_id)->first();

            $css_arr['borrow_id'] = $c_borrow->id;
            $css_arr['borrower_name'] = $user->name;
            $css_arr['email'] = $user->email;
            $css_arr['item_name'] = $css_item->item_name;
            $css_arr['quantity'] = $c_borrow->quantity;
            $css_arr['type'] = $css_item->item_type;
            $css_arr['expired_at'] = $css_item->expired_at;
            $css_arr['created_at'] = $css_item->created_at;
            $css_arr['updated_at'] = $css_item->updated_at;

            if ($c_borrow->status == 1) {
                $css_arr['status'] = "Pending";
            } else if ($c_borrow->status == 2) {
                $css_arr['status'] = "Approved";
            } else if ($c_borrow->status == 3) {
                $css_arr['status'] = "Rejected";
            } else if ($c_borrow->status == 4) {
                $css_arr['status'] = "Returned";
            }

            if ($c_borrow->is_returned == 0) {
                $css_arr['is_returned'] = "No";
            } else {
                $css_arr['is_returned'] = "Yes";
            }

            array_push($new_css, $css_arr);
        }

        foreach($epas_borrows as $e_borrow) {
            $user = User::where('id',$e_borrow->user_id)->first();
            $epas_item = EPASItem::where('id',$e_borrow->item_id)->first();

            $epas_arr['borrow_id'] = $e_borrow->id;
            $epas_arr['borrower_name'] = $user->name;
            $epas_arr['email'] = $user->email;
            $epas_arr['item_name'] = $epas_item->item_name;
            $epas_arr['quantity'] = $e_borrow->quantity;
            $epas_arr['type'] = $epas_item->item_type;
            $epas_arr['expired_at'] = $epas_item->expired_at;
            $epas_arr['created_at'] = $epas_item->created_at;
            $epas_arr['updated_at'] = $epas_item->updated_at;

            if ($e_borrow->status == 1) {
                $epas_arr['status'] = "Pending";
            } else if ($e_borrow->status == 2) {
                $epas_arr['status'] = "Approved";
            } else if ($e_borrow->status == 3) {
                $epas_arr['status'] = "Rejected";
            } else if ($e_borrow->status == 4) {
                $epas_arr['status'] = "Returned";
            }

            if ($e_borrow->is_returned == 0) {
                $epas_arr['is_returned'] = "No";
            } else {
                $epas_arr['is_returned'] = "Yes";
            }

            array_push($new_epas, $epas_arr);
        }

        return view('admin.borrow', [
                'css_borrow'  => $new_css,
                'epas_borrow' => $new_epas
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        if ($request->category == "CSS") {
            if ($request->status == 2) { // Approved
                $borrow_item = BorrowItem::find($request->id);
                $css_item = CSSItem::find($borrow_item->item_id);

                BorrowItem::find($request->id)
                    ->update(['status' => $request->status]);
            } else if ($request->status == 3) { // Rejected
                BorrowItem::find($request->id)
                    ->update(['status' => $request->status]);

                $borrow_item = BorrowItem::find($request->id);
                $css_item = CSSItem::find($borrow_item->item_id);

                $total_quantity = (int) $css_item->item_quantity;
                $borrowed_quantity = (int) $request->quantity;

                $update_css = CSSItem::find($css_item->id)->update(
                    ['item_quantity' => $total_quantity + $borrowed_quantity]
                );

            } else if ($request->status == 4) { // Returned
                $borrow_item = BorrowItem::find($request->id);
                $css_item = CSSItem::find($borrow_item->item_id);

                $total_quantity = (int) $css_item->item_quantity;
                $borrowed_quantity = (int) $request->quantity;
                
                $update_css = CSSItem::find($css_item->id)->update(
                    ['item_quantity' => $total_quantity + $borrowed_quantity]
                );

                BorrowItem::find($request->id)
                    ->update([
                        'status' => $request->status,
                        'is_returned' => 1
                    ]);
            }
        }

        if ($request->category == "EPAS") {
            if ($request->status == 2) { // Approved
                $borrow_item = BorrowItem::find($request->id);
                $epas_item = EPASItem::find($borrow_item->item_id);

                BorrowItem::find($request->id)
                    ->update(['status' => $request->status]);
            } else if ($request->status == 3) { // Rejected
                BorrowItem::find($request->id)
                    ->update(['status' => $request->status]);

                $borrow_item = BorrowItem::find($request->id);
                $epas_item = EPASItem::find($borrow_item->item_id);

                $total_quantity = (int) $epas_item->item_quantity;
                $borrowed_quantity = (int) $request->quantity;

                $update_epas = EPASItem::find($epas_item->id)->update(
                    ['item_quantity' => $total_quantity + $borrowed_quantity]
                );

            } else if ($request->status == 4) { // Returned
                $borrow_item = BorrowItem::find($request->id);
                $epas_item = EPASItem::find($borrow_item->item_id);

                $total_quantity = (int) $epas_item->item_quantity;
                $borrowed_quantity = (int) $request->quantity;

                $update_epas = EPASItem::find($epas_item->id)->update(
                    ['item_quantity' => $total_quantity + $borrowed_quantity]
                );

                BorrowItem::find($request->id)
                    ->update([
                        'status' => $request->status,
                        'is_returned' => 1
                    ]);
            }
        }
        

        return response()->json([
            'success' => 'Updated status. Redirecting to Borrow Items.',
            'code'    => '200'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
