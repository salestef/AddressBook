<!doctype html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{--<meta name="csrf-token" content="{{ csrf_token() }}" />--}}
    {{--<meta name="_token" content="{!! csrf_token() !!}"/>--}}

    <title>AddressBook</title>
    {{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/css/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/js/main.js"></script>
</head>


<body>
<section>


    {{ $slot }}

    <footer>&copy; Copyright <?=date('Y')?> <b>AddressBook</b></footer>

</section>



<!-- Modal -->
<div class="modal fade" id="user-modal" role="dialog">
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
                <button type="submit" id="add-submit" class="user_submit" data-method="add" data-agency-id="" data-user-id="">Save</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<!-- Modal Edit -->
<div class="modal fade" id="user-modal-edit" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit contact</h4>
            </div>
            <div class="modal-body">
                <label for="first_name_user_edit"><b>First Name</b></label>
                <input id="first_name_user_edit" type="text" placeholder="Enter name" name="first_name_user_edit" required>
                <label for="last_name_user_edit"><b>Last Name</b></label>
                <input id="last_name_user_edit" type="text" placeholder="Enter last name" name="last_name_user_edit" required>
                <label for="email_user_edit"><b>Email</b></label>
                <input id="email_user_edit" type="text" placeholder="Enter email" name="email_user_edit" required>
                <label for="web_user_edit"><b>Web</b></label>
                <input id="web_user_edit" type="text" placeholder="Enter web" name="web_user_edit" required>
                <label for="phone_user_edit"><b>Phone Number</b></label>
                <input id="phone_user_edit" type="text" placeholder="Enter phone number" name="phone_user_edit" required>
                {{--<label for="password_user_edit"><b>Pasword</b></label>--}}
                {{--<input id="password_user_edit" type="password" placeholder="Enter web" name="password_user_edit" required>--}}
                <button type="submit" class="user_submit" data-method="edit" data-agency-id="" data-user-id="">Save</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="user-modal-delete" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="text-align: center;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are you sure you want to delete this contact?</h4>
            </div>
            <div class="modal-body" >
                <button type="submit" class="user_submit button-delete" data-method="delete" data-agency-id="" data-user-id="">Delete</button>
                <button type="button" class="button-neutral"  data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
{{----}}
<script>

    $(document).delegate(".button-modal", "click", function() {
        manageModals(this);
    });

    // $( document ).ajaxComplete(function() {
    //     manageAgencyUser();
    // });
    $(document).ready(function () {
        manageAgencyUser();
    });
</script>

</body>
</html>
