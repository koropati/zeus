<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

use App\Permissions\Permission;
use App\Json\JSON;
use DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_CONTACTS)) {
            abort(403);
        }
        return view('contact.index');
    }

    public function getContacts(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_RETRIEVE_CONTACTS)) {
            abort(403);
        }
        if ($request->ajax()) {
            $data = Contact::with('user')->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', 'contact.action')
                ->addColumn('owner', function(Contact $contact){
                    return $contact->user->name;
                })
                ->addColumn('status', function(Contact $contact){
                    if($contact->is_emergency){
                        return '<span class="label label-pill label-danger">Emergency Contact</span>';
                    }else{
                        return '<span class="label label-pill label-success">Not Emergency</span>';
                    }
                })
                ->rawColumns(['action', 'owner', 'status'])
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
        if (!auth()->user()->can(Permission::CAN_CREATE_CONTACTS)) {
            abort(403);
        }
        $response = new JSON();
        $contactID = $request->id;

        $data = Contact::updateOrCreate(
            [
                'id' => $contactID
            ],
            [
                'name' => $request->name, 
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'user_id' => $request->user_id,
                'is_emergency' => $request->is_emergency ? $request->is_emergency : '0',
            ]
        );
        return $response->create($data, "Success Store Data!", 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_UPDATE_CONTACTS)) {
            abort(403);
        }
        $response = new JSON();

        $where = array('id' => $request->id);
        $data = Contact::with('user')->where($where)->first();

        return $response->create($data, "Success", 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!auth()->user()->can(Permission::CAN_DELETE_CONTACTS)) {
            abort(403);
        }
        $response = new JSON();
        $data = Contact::where('id',$request->id)->delete();
        
        return $response->create($data, "Delete Success", 200);
    }
}
