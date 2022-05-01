<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\BorrowItem;
use App\User;
use App\CSSItem;
use App\EPASItem;

class EPASUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = EPASItem::where('item_status','!=','Defective')
            ->where('item_quantity','!=',0)
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('user.available', ['items' => $items]);
    }

    public function borrow_item(Request $request)
    {
        $epas_item = EPASItem::find($request->id);
        $update_epas = EPASItem::find($epas_item->id)->update(
            ['item_quantity' => $epas_item->item_quantity - $request->quantity]
        );

        $borrow = new BorrowItem;
        $borrow->user_id = auth()->user()->id;
        $borrow->item_id = $request->id;
        $borrow->quantity = $request->quantity;
        $borrow->category = "EPAS";
        $borrow->status = 1;
        $borrow->is_returned = 0;
        $borrow->save();

        return response()->json([
            'message' => 'Submitted borrowed items. Redirecting to Borrow Items.',
            'code'    => '200'
        ], 200);
    }

    public function borrowed()
    {
    	$borrowed_items = BorrowItem::where('category', 'EPAS')
               ->where('user_id', auth()->user()->id)
               ->orderBy('updated_at', 'desc')
               ->get();

        $new_epas = [];

        foreach($borrowed_items as $e_returned) {
            $user = User::where('id',$e_returned->user_id)->first();
            $epas_item = EPASItem::where('id',$e_returned->item_id)->first();

            $epas_arr['borrow_id'] = $e_returned->id;
            $epas_arr['borrower_name'] = $user->name;
            $epas_arr['email'] = $user->email;
            $epas_arr['item_name'] = $epas_item->item_name;
            $epas_arr['quantity'] = $e_returned->quantity;
            $epas_arr['type'] = $epas_item->item_type;
            $epas_arr['expired_at'] = $epas_item->expired_at;
            $epas_arr['created_at'] = $epas_item->created_at;
            $epas_arr['updated_at'] = $epas_item->updated_at;

            if ($e_returned->status == 1) {
                $epas_arr['status'] = "Pending";
            } else if ($e_returned->status == 2) {
                $epas_arr['status'] = "Approved";
            } else if ($e_returned->status == 3) {
                $epas_arr['status'] = "Rejected";
            } else if ($e_returned->status == 4) {
                $epas_arr['status'] = "Returned";
            }

            if ($e_returned->is_returned == 0) {
                $epas_arr['is_returned'] = "No";
            } else {
                $epas_arr['is_returned'] = "Yes";
            }

            array_push($new_epas, $epas_arr);
        }

        return view('user.epas_borrowed', ['borrowed_items' => $new_epas]);
    }

    public function returned()
    {
    	$returned_items = BorrowItem::where('category', 'EPAS')
               ->where(['user_id' => auth()->user()->id, 'status' => 4])
               ->orderBy('updated_at', 'desc')
               ->get();

        $new_epas = [];

        foreach($returned_items as $e_returned) {
            $user = User::where('id',$e_returned->user_id)->first();
            $epas_item = EPASItem::where('id',$e_returned->item_id)->first();

            $epas_arr['borrow_id'] = $e_returned->id;
            $epas_arr['borrower_name'] = $user->name;
            $epas_arr['email'] = $user->email;
            $epas_arr['item_name'] = $epas_item->item_name;
            $epas_arr['quantity'] = $e_returned->quantity;
            $epas_arr['type'] = $epas_item->item_type;
            $epas_arr['expired_at'] = $epas_item->expired_at;
            $epas_arr['created_at'] = $epas_item->created_at;
            $epas_arr['updated_at'] = $epas_item->updated_at;

            $epas_arr['status'] = "Returned";

            if ($e_returned->is_returned == 0) {
                $epas_arr['is_returned'] = "No";
            } else {
                $epas_arr['is_returned'] = "Yes";
            }

            array_push($new_epas, $epas_arr);
        }

        return view('user.epas_returned', ['returned_items' => $new_epas]);
    }

    public function account()
    {   
        $account = User::where('id',auth()->user()->id)->first();
        return view('user.account', ['account' => $account]);
    }

    public function update_account(Request $request)
    {   
        $id = auth()->user()->id;
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email,'.$id.',id',
            // 'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->passes()) {
            User::find(auth()->user()->id)
            ->update($request->all());

            return response()->json([
                'success' => 'Updated account. Redirecting to Dashboard',
                'code'    => '200'
            ], 200);
        }

        return response()->json([
            'error' => $validator->errors()->all(),
            'code' => '422'
        ]);
    }
}
