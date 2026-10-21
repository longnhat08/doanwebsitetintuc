<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderByDesc('created_at')->paginate(15);

        return view('admin.contacts', compact('contacts'));
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back()->with('status', 'Đã xóa liên hệ.');
    }
}
