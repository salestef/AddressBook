<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    //
    public function index(){
        $id = Auth::user()->id;
        $user = User::with(["professions", "agency"])->find($id);
        return view('contact.index', [
            "user" => $user
        ]);
    }

    public function edit($id){
        $user = User::with(["professions", "agency"])->find($id);
        $professions = Profession::all();
        if($user->id != Auth::user()->id) return redirect('/contact');
        return view('contact.contact-single', [
            "user" => Auth::user(),
            "professions" => $professions
        ]);
    }

    public function update(Request $request, $id){
        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->web = $request->web;
        $user->email = $request->email;
        $user->phone_number = $request->phone;
        $professions = $request->professions;
        $user->professions()->sync($professions);
        $user->save();
        return redirect('/contact/' . $id);

    }
}
