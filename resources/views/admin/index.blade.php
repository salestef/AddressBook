<x-layout>
@include('admin._header')
<a href="/admin/agency/add">Add new agency</a>
    <div class="agency-wrapper">
@foreach($agencies as $agency)
    <div class="agency-card">
        <a href="/admin/agency/{{$agency->id}}"><h3>Naziv: {{$agency->name}}</h3></a>
        <p>Zemlja: {{$agency->city->country->name}}</p>
        <p>Grad: {{$agency->city->name}}</p>
        <p>Email: {{$agency->email}}</p>
        <p>Web: {{$agency->web}}</p>
        <p>Phone: {{$agency->phone}}</p>
        <p>Users:</p>
        <a href="/admin/contact/add">Add Contact</a>
        <hr>
    @if($agency->users)
            @foreach($agency->users as $agencyUser)
                <a href="/admin/contact/{{$agencyUser->id}}"><p>Ime: {{$agencyUser->first_name}} {{$agencyUser->last_name}}</p></a>
                <p>Rola: {{$agencyUser->role}}</p>
                <p>Email: {{$agencyUser->email}}</p>
                <p>Phone: {{$agencyUser->phone_number}}</p>
            @endforeach
        @endif
    </div>
@endforeach
    </div>
<script>
    $(document).ready(function () {
        getAgencies();
    });
    function getAgencies() {
        var agencyWrapper = $(".agency-wrapper");
        var agenciesSection = '';
        $.ajax({
            url: "/api/agencies",
            type: 'GET',
            dataType: "JSON",
            success: function( agencies ) {
                $.each(agencies, function (index,agency) {
                    agenciesSection += "<div class='agency-card'>";
                    agenciesSection += "<h2>Info agencije</h2>";
                    agenciesSection += "<p>Naziv:" + agency.name + "</p>";
                    agenciesSection += "<p>Grad:" + agency.city.name + "</p>";
                    agenciesSection += "<p>Email:" + agency.email + "</p>";
                    agenciesSection += "<p>Web:" + agency.web + "</p>";
                    agenciesSection += "<p>Telefon:" + agency.phone_number + "</p>";
                    if(!$.isEmptyObject(agency.users)){
                        agenciesSection += "<div><h3>Kontakti</h3>";
                        $.each(agency.users, function (indexUser,contact) {
                            agenciesSection += "<div class='user-card' style='background-color: lightgray; border: 1px solid blue; padding: 10px'>";
                            agenciesSection += "<p>Ime:" + contact.first_name + " " + contact.last_name + "</p>";
                            agenciesSection += "<p>Rola:" + contact.role + "</p>";
                            agenciesSection += "<p>Email:" + contact.email + "</p>";
                            agenciesSection += "<p>Telefon:" + contact.phone_number + "</p>";

                            agenciesSection += "</div>";
                        });
                        agenciesSection += "</div>";

                    }
                    agenciesSection += "</div><hr>";
                    console.log(agency);
                });
                agencyWrapper.html(agenciesSection);

            }
        });
    }
</script>

</x-layout>
