<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DeviceLog;
use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;

use App\Permissions\Permission;
use App\Json\JSON;
use DataTables;
use Hash;

class MyDeviceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_MY_DEVICE_LOGS)) {
            abort(403);
        }
        $itemId = array('device_id' => $request->id_device);
        if($request->id_device){
            $device = Device::with('user')->where('id', '=', $request->id_device)->where('user_id', '=', auth()->user()->id)->first();
        }else{
            return view('my-device.index');
        }
        return view('my-device-log.index')->with('device', $device);
    }

    public function getDeviceLogs(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_MY_DEVICE_LOGS)) {
            abort(403);
        }
        if ($request->ajax()) {
            $itemId = array('device_id' => $request->id_device);
            $data = DeviceLog::with('device')->where($itemId)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'my-device-log.action')
                ->addColumn('device', function(DeviceLog $device_log){
                    if($device_log){
                        return $device_log->device->uuid;
                    }else{
                        return "NONE";
                    }
                    
                })
                ->rawColumns(['action', 'device'])
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeviceLog  $deviceLog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_MY_DEVICE_LOGS)) {
            abort(403);
        }
        $response = new JSON();
        $itemId = array('id' => $request->id);
        $data = DeviceLog::with('device')->where($itemId)->first();
        return $response->create($data, "Success", 200);
    }

}
