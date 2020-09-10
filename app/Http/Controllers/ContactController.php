<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::all();

        return response()->json($contacts);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validador = Validator::make($request->all(), [
            'name' => 'required|min:6|max:255',
            'email' => 'required|min:6|max:255|email|unique:contacts'
        ]);

        if ($validador->fails()) {
            $error = $validador->errors();
            return response()->json($error, 400);
        }

        $contact = Contact::create($request->all());
        return response()->json($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return response()->json($contact);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $validador = Validator::make($request->all(), [
            'name' => 'required|min:6|max:255',
            'email' => 'required|min:6|max:255|email|unique:contacts,'. $contact->id,
        ]);

        if ($validador->fails()) {
            $error = $validador->errors();
            return response()->json($error, 400);
        }

        $contact->update($request->all());
        return response()->json($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $deleted = $contact->delete();
        return response()->json('Contato deletado com sucesso', 200);
    }
}
