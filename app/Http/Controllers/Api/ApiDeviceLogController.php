<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DeviceLog;
use App\Models\Device;
use Illuminate\Http\Request;

use App\Permissions\Permission;
use App\Json\JSON;

use Validator;

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

        $input = $request->all();
    
        $validator = Validator::make($input, [
            'device_id' => 'required',
            'ip_address' => 'required',
            'status' => 'required',
            'code' => 'required'
        ]);

        if($validator->fails()){
            return $response->create("", $validator->errors(), 400);
        }

        $where = array('id' => $input["device_id"]);
        $dataDevice = Device::with('user')->where($where)->first();

        if($dataDevice == null){
            return $response->create("", "Device ID Not Found!", 400);
        }

        // $data = DeviceLog::create($input);
        $data = DeviceLog::create(
            [
                'device_id' => $dataDevice->id, 
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
