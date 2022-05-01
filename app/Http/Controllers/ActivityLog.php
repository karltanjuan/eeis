<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class ActivityLog extends Controller
{
    public function index()
    {
        $audits = \OwenIt\Auditing\Models\Audit::with('user')
            ->orderBy('created_at', 'desc')->get();

        return view('admin.activity_log', ['audits' => $audits]);

    }
}
