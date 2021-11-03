<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\City;
use App\Models\Profession;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
//    public function index()
//    {
//        return view('admin.index', [
//            "agencies" =>  Agency::with(["city","city.country","users" => function($query){
//                $query->where('users.role', '=', 'contact');
//            }])->get()
//        ]);
//    }

    public function index()
    {
        return view('admin.index');
    }

    public function agency($method){
        return view('admin.agency-single', [
            "method" => $method,
            "users" => User::with(["professions", "agency"])->where('role','=','contact')->get(),
            "cities" =>  City::with('country')->get()
        ]);
    }

    public function contact($method){
        return view('admin.contact-single', [
            "method" => $method,
            "professions" =>  Profession::all()
        ]);
    }
}
