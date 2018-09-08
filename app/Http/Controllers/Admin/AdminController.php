<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('admins.index');
    }

    public function changeRoles(Request $request)
    {
        DB::table('role_user')->where('user_id', $request->user_id)->update(['role_id' => $request->id]);
        return response('You have Change ('.$request->user_id.') role to ('.$request->id.')', $status = 200);
    }
}
