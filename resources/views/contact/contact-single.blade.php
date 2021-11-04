@extends('layouts.contact-layout')
@section('content')
    <form action="/contact/update/{{$user->id}}" method="post" id="contact-form">
        @csrf
        <label for="first_name"><b>First Name</b></label>
        <input id="first_name" type="text" placeholder="Enter name" name="first_name" value="{{$user->first_name}}" required>
        <label for="last_name"><b>Last Name</b></label>
        <input id="last_name" type="text" placeholder="Enter last name" name="last_name" value="{{$user->last_name}}" required>

        <label for="professions">Professions</label>
        <select class="form-select" id="professions" name="professions[]" multiple aria-label="multiple select example">
            @foreach($professions as $profession)
                <option value="{{$profession->id}}"
                    @if(in_array($profession->id,$user->professions->pluck('id')->toArray()))
                        {{'selected'}}
                    @endif>{{$profession->name}}</option>
            @endforeach
        </select>

        <label for="email"><b>Email</b></label>
        <input id="email" type="text" placeholder="Enter email" name="email" value="{{$user->email}}" required>
        <label for="web"><b>Web</b></label>
        <input id="web" type="text" placeholder="Enter web" name="web" value="{{$user->web}}" required>
        <label for="phone"><b>Phone Number</b></label>
        <input id="phone" type="text" placeholder="Enter phone number" name="phone" value="{{$user->phone_number}}" required>
        {{--<label for="password"><b>Pasword</b></label>--}}
        {{--<input id="password" type="password" placeholder="Enter web" name="password" value="{{$user->password}}" required>--}}
        <button type="submit" id="contact_submit" class="contact_submit" >Save</button>
    </form>
@stop

<script>
    $("#professions").mousedown(function(e){
        e.preventDefault();

        var select = this;
        var scroll = select .scrollTop;

        e.target.selected = !e.target.selected;

        setTimeout(function(){select.scrollTop = scroll;}, 0);

        $(select ).focus();
    }).mousemove(function(e){e.preventDefault()});
</script>
