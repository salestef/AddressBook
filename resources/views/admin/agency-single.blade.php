<x-layout>
    <?php $method = \Illuminate\Support\Facades\Request::route('method'); ?>

    <div class="container">

        @include('admin._header')
        <div class="agency-form">
            <form action="/api/agencies" method="post" id="agency-form">
                @csrf
                <label for="name_agency"><b>Name</b></label>
                <input id="name_agency" type="text" placeholder="Enter name" name="name" required>
                <label for="city_agency">City</label>
                <select name="city_id" id="city_agency">
                    @foreach($cities as $city)
                        <option value="{{$city->id}}">{{$city->name}}</option>
                    @endforeach
                </select>
                <br>
                <label for="address_agency"><b>Address</b></label>
                <input id="address_agency" type="text" placeholder="Enter address" name="address" required>
                <label for="email_agency"><b>Email</b></label>
                <input id="email_agency" type="text" placeholder="Enter email" name="email" required>
                <label for="web_agency"><b>Web</b></label>
                <input id="web_agency" type="text" placeholder="Enter web" name="web" required>
                <label for="phone_agency"><b>Phone</b></label>
                <input style="margin-bottom: 40px" id="phone_agency" type="text" placeholder="Enter phone"
                       name="phone_number" required>

                {{-- Contacts start --}}
                <div id="agency-contacts"></div>
                {{-- Contacts end --}}
                <button type="submit" id="agency_submit">Save</button>
            </form>
        </div>
    </div>






    <script>
        var add = 'add';
        $(document).ready(function () {
            <?php
            if($method != "add"){ ?>
            getAgency({{ $method }});
            // manageAgencyUser();
            <?php } ?>
            saveAgency({{ $method }});
        });
    </script>
</x-layout>
