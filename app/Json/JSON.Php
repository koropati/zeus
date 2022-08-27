<?php
namespace App\JSON;
class JSON
{
    public $response = [
        'status' => 200,
        'data' => null,
        'message' => "",
    ];
    
    function setStatus($status) {
        $this->response['status'] = $status;
    }

    function setData($data) {
        $this->response['data'] = $data;
    }

    function setMessage($msg) {
        $this->response['message'] = $msg;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($data, $msg, $status) {
        $response["status"] = $status;
        $response["data"] = $data;
        $response["message"] = $msg;
        return Response()->json($response, $status);
    }
}
