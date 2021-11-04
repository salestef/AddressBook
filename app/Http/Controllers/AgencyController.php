<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index()
    {
        return Agency::with(["city","city.country", "users" => function ($query) {
            $query->where('users.role', '=', 'contact');
        }])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'address' => 'required',
                'email' => 'required',
                'phone_number' => 'required',
                'web' => 'required',
            ]
        );

        return Agency::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return is_numeric($id) ? Agency::with(["city","city.country", "users" => function ($query) {
            $query->where('users.role', '=', 'contact');
        }])->find($id) : null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agency = Agency::with(["city","city.country", "users" => function ($query) {
            $query->where('users.role', '=', 'contact');
        }])->find($id);
        return $agency->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Agency::destroy($id);
    }

    /**
     * Search for a name
     *
     * @param  string $name
     * @return \Illuminate\Http\Response
     */
    public function search($name)
    {
        return Agency::where('name', 'like', '%' . $name . '%')->get();
    }

    /**
     * get agency Users.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function agencyContacts($id){
        return User::where([
            ['role', '=', 'contact'],
            ['agency_id', '=', $id]
        ])->get();
    }
}
