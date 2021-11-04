@extends('layouts.contact-layout')
@section('content')
    <div class='contact-card'>
        <h2 style='border-bottom: 1px solid saddlebrown'><a class='default-link' href='/contact/{{$user->id}}'>{{ucwords($user->first_name . " " . $user->last_name)}}</a></h2>
        <b>Email:</b><p> {{ $user->email}}  </p>
        <b>Web:</b><p>{{$user->web}}  </p>
        <b>Professions:</b><p>{{ucwords(implode(", ",$user->professions->pluck('name')->toArray()))}}  </p>
        <b>Phone:</b><p style='margin-bottom: 40px'>{{$user->phone_number}}</p>
        <div>
            <h4 style='background-color: lightgray; padding: 3px'>Agency info</h4>
            <b>Name:</b><p> {{ $user->agency->email}}  </p>
            <b>Email:</b><p> {{ $user->agency->email}}  </p>
            <b>Web:</b><p>{{$user->agency->web}}  </p>
            <b>Phone:</b><p style='margin-bottom: 40px'>{{$user->agency->phone_number}}</p>
        </div>
    </div>
@stop
