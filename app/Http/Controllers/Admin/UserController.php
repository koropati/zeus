<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Permissions\Permission;
use App\Json\JSON;
use DataTables;
use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_USERS)) {
            abort(403);
        }
        return view('user.index');
    }

    public function getUsers(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_USERS)) {
            abort(403);
        }
        if ($request->ajax()) {
            $data = User::with('account')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('action', function($row){
                //     $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm" data-toggle="modal" data-target=".modal-user-edit" data-id="'.$row->id.'">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                //     return $actionBtn;
                // })
                ->addColumn('action', 'user.action')
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function dropDownUser(Request $request){
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_USERS)) {
            abort(403);
        }
        $data = [];
        if($request->filled('q')){
            $data = User::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }else{
            $data = User::all();
        }
    
        return Response()->json($data,200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_CREATE_USERS)) {
            abort(403);
        }
        $response = new JSON();
        $userID = $request->id;
        $password_encripted = "";
        if ($request->password){
            if ($request->password != $request->password_confirm){
                return $response->create("", "Password Confirmation Is Not Same!", 400);
            }else{
                $password_encripted = Hash::make($request->password);
            }
        }
        $user = User::updateOrCreate(
            [
                'id' => $userID
            ],
            [
                'name' => $request->name, 
                'email' => $request->email,
                'password' => $password_encripted,
            ]
        );

        $user->account()->updateOrCreate(['user_id'=>$user->id],[
            'account_type' => $request->account_type,
            'device_number' => $request->device_number,
            'request_quota' => $request->request_quota,
            'expired_at' => $request->expired_at,
            'is_active' => $request->is_active,
        ]);
        return $response->create($user, "Success Store Data", 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_UPDATE_USERS)) {
            abort(403);
        }
        $response = new JSON();

        $where = array('id' => $request->id);
        $user = User::with('account')->where($where)->first();

        return $response->create($user, "Success", 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_DELETE_USERS)) {
            abort(403);
        }
        $response = new JSON();
        $user = User::where('id',$request->id)->delete();
        
        return $response->create($user, "Delete Success", 200);
    }
}
