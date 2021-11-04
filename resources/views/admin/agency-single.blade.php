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

                {{--<label for="users_agency">Contacts</label>--}}
                {{--<select class="form-select" id="users_agency" name="users" multiple aria-label="multiple select example">--}}
                {{--@foreach($users as $user)--}}
                {{--<option value="{{$user->id}}">{{ucwords($user->first_name . " " . $user->last_name)}}</option>--}}
                {{--@endforeach--}}
                {{--</select>--}}
                {{--<br>--}}


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
                <?php if($method != 'add'){ ?>
                <button style="width: 200px;" type="button" class="button-add" data-toggle="modal"
                        data-target="#addUser">Add Contact
                </button>
                <div id="agency-contacts" class="agency-{{$method}}">

                </div>
                <?php } ?>


                {{-- Contacts end --}}
                <button type="submit" id="agency_submit">Save</button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addUser" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add contact</h4>
                </div>
                <div class="modal-body">
                    <label for="first_name_user"><b>First Name</b></label>
                    <input id="first_name_user" type="text" placeholder="Enter name" name="first_name_user" required>
                    <label for="last_name_user"><b>Last Name</b></label>
                    <input id="last_name_user" type="text" placeholder="Enter last name" name="last_name_user" required>
                    <label for="email_user"><b>Email</b></label>
                    <input id="email_user" type="text" placeholder="Enter email" name="email_user" required>
                    <label for="web_user"><b>Web</b></label>
                    <input id="web_user" type="text" placeholder="Enter web" name="web_user" required>
                    <label for="phone_user"><b>Phone Number</b></label>
                    <input id="phone_user" type="text" placeholder="Enter phone number" name="phone_user" required>
                    <label for="password_user"><b>Pasword</b></label>
                    <input id="password_user" type="password" placeholder="Enter web" name="password_user" required>
                    <button type="submit" class="user_submit" data-method="add" data-agency-id="{{$method}}" data-user-id="">Save</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        // $("#users_agency").mousedown(function(e){
        //     e.preventDefault();
        //
        //     var select = this;
        //     var scroll = select .scrollTop;
        //
        //     e.target.selected = !e.target.selected;
        //
        //     setTimeout(function(){select.scrollTop = scroll;}, 0);
        //
        //     $(select ).focus();
        // }).mousemove(function(e){e.preventDefault()});

        var add = 'add';
        $(document).ready(function () {
            <?php
            if($method != "add"){ ?>
            getAgency({{ $method }});
            manageAgencyUser();
            <?php } ?>
            saveAgency({{ $method }});
        });
    </script>
</x-layout>
