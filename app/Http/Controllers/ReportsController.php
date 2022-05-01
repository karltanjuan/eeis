<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BorrowItem;
use App\User;
use App\CSSItem;
use App\EPASItem;
use PDF;

class ReportsController extends Controller
{
    public function index()
    {
    	return view('admin.reports');
    }

    public function download_pdf($filter)
    {	
    	if ($filter == "returned_css") {
    		$css_returned = BorrowItem::where('category', 'css')
               ->orderBy('created_at', 'asc')
               ->get();

	        $new_css = [];

	        foreach($css_returned as $c_borrow) {

	        	if ($c_borrow->status == 4) {
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
	        }

	    	$pdf = PDF::loadView('admin.report_template.returned_css', ['css' => $new_css]);
			return $pdf->download('returned_css_item.pdf');
    	}

    	if ($filter == "borrowed_css") {
    		$css_borrows = BorrowItem::where('category', 'css')
               ->orderBy('created_at', 'asc')
               ->get();

	        $new_css = [];

	        foreach($css_borrows as $c_borrow) {

	        	if ($c_borrow->status != 4) {
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
	        }

	        $pdf = PDF::loadView('admin.report_template.borrowed_css', ['css' => $new_css]);
			return $pdf->download('borrowed_css_item.pdf');
    	}

    	if ($filter == "new_css") {
    		$css = CSSItem::where('item_status', 'Brand New')->get();
	    	$pdf = PDF::loadView('admin.report_template.new_css', ['css' => $css]);
			return $pdf->download('brand_new_css_item.pdf');
    	} 

    	if ($filter == "good_css") {
    		$css = CSSItem::where('item_status', 'Good')->get();
	    	$pdf = PDF::loadView('admin.report_template.good_css', ['css' => $css]);
			return $pdf->download('good_css_item.pdf');
    	} 

    	if ($filter == "defective_css") {
    		$css = CSSItem::where('item_status', 'Defective')->get();
	    	$pdf = PDF::loadView('admin.report_template.defective_css', ['css' => $css]);
			return $pdf->download('defective_css_item.pdf');
    	}

    	if ($filter == "returned_epas") {
    		$epas_returned = BorrowItem::where('category', 'epas')
               ->orderBy('created_at', 'asc')
               ->get();

	        $new_epas = [];

	        foreach($epas_returned as $e_borrow) {

	        	if ($e_borrow->status == 4) {
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
	        }

	        $pdf = PDF::loadView('admin.report_template.returned_epas', ['epas' => $new_epas]);
	        return $pdf->download('returned_epas_item.pdf');
    	}

    	if ($filter == "borrowed_epas") {
	    	$epas_borrows = BorrowItem::where('category', 'epas')
	               ->orderBy('created_at', 'asc')
	               ->get();

	        $new_epas = [];

	        foreach($epas_borrows as $e_borrow) {

	        	if ($e_borrow->status != 4) {
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
	        }

	        $pdf = PDF::loadView('admin.report_template.borrowed_epas', ['epas' => $new_epas]);
			return $pdf->download('borrowed_epas_item.pdf');
    	} 

    	if ($filter == "new_epas") {
    		$epas = EPASItem::where('item_status', 'Brand New')->get();
	    	$pdf = PDF::loadView('admin.report_template.new_epas', ['epas' => $epas]);
			return $pdf->download('brand_new_epas_item.pdf');
    	} 

    	if ($filter == "good_epas") {
    		$epas = EPASItem::where('item_status', 'Good')->get();
	    	$pdf = PDF::loadView('admin.report_template.good_epas', ['epas' => $epas]);
			return $pdf->download('good_epas_item.pdf');
    	} 

    	if ($filter == "defective_epas") {
    		$epas = EPASItem::where('item_status', 'Defective')->get();
	    	$pdf = PDF::loadView('admin.report_template.defective_epas', ['epas' => $epas]);
			return $pdf->download('defective_epas_item.pdf');
    	}
    }

    public function borrowed_css()
    {	
    	$css_borrows = BorrowItem::where('category', 'css')
               ->orderBy('created_at', 'asc')
               ->get();

        $new_css = [];

        foreach($css_borrows as $c_borrow) {

        	if ($c_borrow->status != 4) {
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
        }

    	return view('admin.report_template.borrowed_css', ['css'=>$new_css]);
    }

    public function returned_css()
    {	
    	$css_borrows = BorrowItem::where('category', 'css')
               ->orderBy('created_at', 'asc')
               ->get();

        $new_css = [];

        foreach($css_borrows as $c_borrow) {

        	if ($c_borrow->status == 4) {
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
        }

    	return view('admin.report_template.returned_css', ['css'=>$new_css]);
    }

    public function borrowed_epas()
    {	
    	$epas_borrows = BorrowItem::where('category', 'epas')
               ->orderBy('created_at', 'asc')
               ->get();

        $new_epas = [];

        foreach($epas_borrows as $e_borrow) {

        	if ($e_borrow->status != 4) {
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
        }

    	return view('admin.report_template.borrowed_epas', ['epas'=>$new_epas]);
    }

    public function returned_epas()
    {	
    	$epas_returned = BorrowItem::where('category', 'epas')
               ->orderBy('created_at', 'asc')
               ->get();

        $new_epas = [];

        foreach($epas_returned as $e_borrow) {

        	if ($e_borrow->status == 4) {
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
        }

    	return view('admin.report_template.returned_epas', ['epas'=>$new_epas]);
    }

    public function new_css()
    {	
    	$css = CSSItem::where('item_status', 'Brand New')->get();
    	return view('admin.report_template.new_css', ['css'=>$css]);
    }

    public function good_css()
    {	
    	$css = CSSItem::where('item_status', 'Good')->get();
    	return view('admin.report_template.good_css', ['css'=>$css]);
    }

    public function defective_css()
    {	
    	$css = CSSItem::where('item_status', 'Defective')->get();
    	return view('admin.report_template.defective_css', ['css'=>$css]);
    }


    public function new_epas()
    {	
    	$epas = EPASItem::where('item_status', 'Brand New')->get();
    	return view('admin.report_template.new_epas', ['epas'=>$epas]);
    }

    public function good_epas()
    {	
    	$epas = EPASItem::where('item_status', 'Good')->get();
    	return view('admin.report_template.good_epas', ['epas'=>$epas]);
    }

    public function defective_epas()
    {	
    	$epas = EPASItem::where('item_status', 'Defective')->get();
    	return view('admin.report_template.defective_epas', ['epas'=>$epas]);
    }

}
