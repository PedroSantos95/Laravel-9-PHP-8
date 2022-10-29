<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    protected function getContacts(){
        return [
            1 => ['id' => 1, 'name' => 'Name 1', 'phone' => '1234567890'],
            2 => ['id' => 2, 'name' => 'Name 2', 'phone' => '2345678901'],
            3 => ['id' => 3, 'name' => 'Name 3', 'phone' => '3456789012'],
        ];
    }
    
    protected function getCompanies(){
        return [
            1 => ['id' => 1, 'name' => 'Company 1', 'contacts' => '3'],
            2 => ['id' => 2, 'name' => 'Company 2', 'contacts' => '5'],
        ];
    }

    public function index()
    {
        $companies = $this->getCompanies();
        $contacts = $this->getContacts();
    
        return view('contacts.index', compact('contacts', 'companies'));
    }

    public function create()
    {
        return view('contacts.create');
    }

    public function show($id)
    {
        $contacts = $this->getContacts();
        abort_if(!isset($contacts[$id]), 404);
        $contact = $contacts[$id];
        return view('contacts.show')->with('contact', $contact);
    }
}
