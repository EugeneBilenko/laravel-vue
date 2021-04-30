<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactRequest;
use App\Http\Requests\DeleteContactsRequest;
use App\Http\Requests\UpdateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        $result = Contact::query()
            ->orderBy('id', 'desc')
            ->get()
            ->transform(function ($item, $key) {
                $item['selected'] = false;
                return $item;
            });

        return response()->json($result);
    }

    public function delete(DeleteContactsRequest $request)
    {
        $ids = $request->get('ids', []);

        Contact::whereIn('id', $ids)
            ->delete();

        return response()->json(['success' => true]);
    }

    public function create(CreateContactRequest $request)
    {
        $result = Contact::create($request->validated());

        return response()->json($result);
    }

    public function update(UpdateContactRequest $request)
    {
        $id = $request->get('id');
        Contact::whereId($id)->update($request->validated());
        $result = Contact::whereId($id)->first();
        return response()->json($result);
    }
}
