<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;

use App\Permissions\Permission;
use App\Json\JSON;
use DataTables;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_DEVICES)) {
            abort(403);
        }
        return view('device.index');
    }

    public function getDevices(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_DEVICES)) {
            abort(403);
        }
        if ($request->ajax()) {
            $data = Device::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'device.action')
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
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_DEVICES)) {
            abort(403);
        }
        $data = [];
        if($request->filled('q')){
            $data = Device::select("uuid", "type", "id")
                        ->where('type', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }else{
            $data = Device::all();
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
        if (!auth()->user()->can(Permission::CAN_CREATE_DEVICES)) {
            abort(403);
        }
        $response = new JSON();
        $dataID = $request->id;

        // Validasi jumlah device yang bisa di buat
        if(!$dataID){
            $where = array('user_id' => $request->user_id);
            $account = Account::where($where)->first();
            
            $where = array('id' => $request->user_id);
            $user = User::with("devices")->where($where)->first();

            if (count($user->devices) >= $account->device_number) {
                return $response->create("", "Device Limit Reached!", 400);
            }
        }

        $data = Device::updateOrCreate(
            [
                'id' => $dataID
            ],
            [
                'user_id' => $request->user_id, 
                'device_type' => $request->device_type,
                'uuid' => $request->uuid,
                'api_key' => $request->api_key,
                'expired_at' => $request->expired_at,
                'is_active' => $request->is_active ? $request->is_active : '0',
                'description' => $request->description,
            ]
        );
        return $response->create($data, "Success Store Data!", 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_UPDATE_DEVICES)) {
            abort(403);
        }
        $response = new JSON();
        $where = array('id' => $request->id);
        $data = Device::with('user')->where($where)->first();
        return $response->create($data, "Success", 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Device  $device
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_DELETE_DEVICES)) {
            abort(403);
        }
        $response = new JSON();
        $data = Device::where('id',$request->id)->delete();
        return $response->create($data, "Delete Success", 200);
    }
}
