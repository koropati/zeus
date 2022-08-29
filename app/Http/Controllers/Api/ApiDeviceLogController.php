<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceLog;
use Illuminate\Http\Request;

use App\Permissions\Permission;
use App\Json\JSON;

class ApiDeviceLogController extends Controller
{
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

        $data = DeviceLog::create(
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
}
