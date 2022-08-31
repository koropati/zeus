<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Device;
use Illuminate\Http\Request;

use App\Permissions\Permission;
use App\Json\JSON;
use DataTables;

class MyDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_MY_DEVICES)) {
            abort(403);
        }
        return view('my-device.index');
    }

    public function getDevices(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_MY_DEVICES)) {
            abort(403);
        }
        if ($request->ajax()) {
            $where = array('user_id' => auth()->user()->id);
            $data = Device::with('user')->where($where)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'my-device.action')
                ->addColumn('owner', function(Device $device){
                    return $device->user->name;
                })
                ->addColumn('status_device', function(Device $device){
                    if($device->is_active){
                        return '<span class="label label-pill label-success">ACTIVE</span>';
                    }else{
                        return '<span class="label label-pill label-danger">NON ACTIVE</span>';
                    }
                })
                ->addColumn('type', function(Device $device){
                    if($device->device_type=="stun_gun"){
                        return '<span class="label label-pill label-primary">STUNT GUN</span>';
                    }else if($device->device_type=="panic_button"){
                        return '<span class="label label-pill label-warning">PANIC BUTTON</span>';
                    }else{
                        return '<span class="label label-pill label-info">OTHER</span>';
                    }
                })
                ->rawColumns(['action', 'owner', 'status_device', 'type'])
                ->make(true);
        }
    }

    public function dropDownDevice(Request $request){
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_MY_DEVICES)) {
            abort(403);
        }
        $data = [];
        if($request->filled('q')){
            $data = Device::select("uuid", "type", "id")
                        ->where('user_id', '=', auth()->user()->id)
                        ->where('type', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }else{
            $data = Device::all();
        }
    
        return Response()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_MY_DEVICES)) {
            abort(403);
        }
        $response = new JSON();
        $itemId = array('id' => $request->id);
        $userIdLogin = array('user_id' => auth()->user()->id);
        $data = Device::with('user')->where($itemId)->where($userIdLogin)->first();
        return $response->create($data, "Success", 200);
    }
}
