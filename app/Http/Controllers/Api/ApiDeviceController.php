<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Contact;
use App\Models\DeviceLog;
use Illuminate\Http\Request;

use App\Permissions\Permission;
use App\Json\JSON;
use App\Mail\ZeusMail;
use Ramsey\Uuid\Uuid;

use Validator;
use Mail;

class ApiDeviceController extends Controller
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
            'api_key' => 'required',
            'ip_address' => 'required',
            'status' => 'required',
            'code' => 'required'
        ]);

        if($validator->fails()){
            return $response->create("", $validator->errors(), 400);
        }

        $where = array('api_key' => $input["api_key"]);
        $dataDevice = Device::with('user')->where($where)->first();
        $myContacts = Contact::where('user_id', '=', $dataDevice->user_id)->get();

        if($dataDevice == null){
            return $response->create("", "Invalid Credentials", 400);
        }

        foreach($myContacts as $contact){
            Mail::to($contact->email)->send(new ZeusMail($contact->email,$contact->name,$dataDevice->user->email,$dataDevice->user->name));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeGet(Request $request)
    {
        $response = new JSON();

        $input = $request->all();
    
        $validator = Validator::make($input, [
            'api_key' => 'required',
            'ip_address' => 'required',
        ]);

        if($validator->fails()){
            return $response->create("", $validator->errors(), 400);
        }

        $where = array('api_key' => $input["api_key"]);
        $dataDevice = Device::with('user')->where($where)->first();
        $myContacts = Contact::where('user_id', '=', $dataDevice->user_id)->get();

        if($dataDevice == null){
            return $response->create("", "Invalid Credentials", 400);
        }

        $dataDetail = "(".$dataDevice->user->name.") SEND EMAIL TO: \n";

        foreach($myContacts as $contact){
            $dataDetail = $dataDetail . "EMAIL: ". $contact->email . ", NAME: " . $contact->name . "\n";
            Mail::to($contact->email)->send(new ZeusMail($contact->email,$contact->name,$dataDevice->user->email,$dataDevice->user->name));
        }

        $myUUID = Uuid::uuid4();
        // $data = DeviceLog::create($input);
        $data = DeviceLog::create(
            [
                'device_id' => $dataDevice->id, 
                'uuid' => $myUUID->toString(),
                'ip_address' => $request->ip_address,
                'status' => "success",
                'code' => "200",
                'data' => $dataDetail,
            ]
        );
        return $response->create($data, "Success Store Data!", 200);
    }
}
