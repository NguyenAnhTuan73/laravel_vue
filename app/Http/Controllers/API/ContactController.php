<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contacts()
    {
        $contacts = Contact::all();
        return response()->json([
            'contacts' => $contacts,
            'message' => 'Contacts',

        ], 200);
    }
    public function saveContact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:contacts',
            'designation' => 'required',
            'contact_no' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'Message' => 'Faild',
            ], 400);
        }
        $user = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'designation' => $request->designation,
            'contact_no' => $request->contact_no,
        ]);
        return response()->json([
            'success' => true,
            'data' => $user,
            'Message' => 'Successfully',
        ], 200);
    }
    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            return response()->json([
                'Message' => 'Contact Deleted Successfully',
            ], 200);
        } else {
            return response()->json([
                'Message' => "Contact with id: $id does not exits",
            ], 400);
        }
    }
    public function getContact($id)
    {
        try {
            $contact = Contact::find($id);
            return response()->json([
                'success' => true,
                'data' => $contact,
            ], 200);
        } catch (\Exception$e) {
            return response()->json([
                'success' => false,
                'Message' => $e->getMessage(),
            ], 400);
        }
    }
    public function updateContact($id, Request $request)
    {
        $contact = Contact::where('id', $id)->first();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->designation = $request->designation;
        $contact->contact_no = $request->contact_no;
        $contact->save();
        return response()->json([
            'message' => 'Contact Update Successfully',
        ], 200);

    }

}
