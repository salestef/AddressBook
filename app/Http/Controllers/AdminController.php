<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            "agencies" =>  Agency::with(["city","users" => function($query){
                $query->where('users.role', '=', 'contact');
            }])->get()
        ]);
    }

//    public function index()
//    {
//        return view('admin.index');
//    }

    public function agencyAdd(){
        return view('admin.agency-single');
    }

    public function agencyEdit($id){
        $agency = Agency::find($id);
        dd($agency->name);
        return view('admin.agency-single', [
            "agency" =>  $agency
        ]);
    }

    public function contactAdd(){
        return view('admin.contact-single');
    }

    public function contactEdit($id){
        $contact = User::find($id);
        dd($contact->first_name);
        return view('admin.contact-single', [
            "contact" =>  $contact
        ]);
    }
}
