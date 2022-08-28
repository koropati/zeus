<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeviceLog;
use Illuminate\Http\Request;

use App\Permissions\Permission;
use App\Json\JSON;
use DataTables;

class DeviceLogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_DEVICE_LOGS)) {
            return redirect('login');
        }
        return view('device-log.index');
    }

    public function getDeviceLogs(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_DEVICE_LOGS)) {
            return redirect('login');
        }
        if ($request->ajax()) {
            $data = DeviceLog::with('device')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'device-log.action')
                ->addColumn('device', function(DeviceLog $device_log){
                    return $device_log->device->uuid;
                })
                ->rawColumns(['action', 'device'])
                ->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = new JSON();
        $dataID = $request->id;

        $data = DeviceLog::updateOrCreate(
            [
                'id' => $dataID
            ],
            [
                'device_id' => $request->device_id, 
                'uuid' => $request->uuid,
                'ip_address' => $request->ip_address,
                'status' => $request->status,
                'code' => $request->code,
                'data' => $request->data ? $request->data : '0',
            ]
        );
        return $response->create($data, "Success Store Data!", 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeviceLog  $deviceLog
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $response = new JSON();
        $where = array('id' => $request->id);
        $data = DeviceLog::with('device')->where($where)->first();
        return $response->create($data, "Success", 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeviceLog  $deviceLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $response = new JSON();
        $data = DeviceLog::where('id',$request->id)->delete();
        return $response->create($data, "Delete Success", 200);
    }
}
