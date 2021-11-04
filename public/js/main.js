function getAgencies() {
    var agencyContactsWrapper = $(".agency-contacts");
    var agenciesSection = '';
    $.ajax({
        url: "/api/agencies",
        type: 'GET',
        dataType: "JSON",
        success: function (agencies) {
            $.each(agencies, function (index, agency) {
                agenciesSection += "<div class='agency-card'>";
                agenciesSection += "<h2 style='border-bottom: 1px solid saddlebrown;'><a class='default-link' href='/admin/agency/" + agency.id + "'>" + agency.name + "</a></h2>";
                agenciesSection += "<b>City:</b><p>" + agency.city.name + "</p>";
                agenciesSection += "<b>Country:</b><p>" + agency.city.country.name + "</p>";
                agenciesSection += "<b>Email:</b><p>" + agency.email + "</p>";
                agenciesSection += "<b>Web:</b><p>" + agency.web + "</p>";
                agenciesSection += "<b>Phone:</b><p style='margin-bottom: 40px'>" + agency.phone_number + "</p>";
                // Add contacts section
                agenciesSection += "<div id='agency-contacts' class='agency-" + agency.id + "'>";
                agenciesSection += agencyContactsSection(agency.users,agency.id);
                agenciesSection += "</div></div><hr>";
            });
            agencyContactsWrapper.html(agenciesSection);
        }
    });
}

function agencyContactsSection(contacts,agencyId){
    var contactsSection = "";
    contactsSection += "<button style='width: 200px;' type='button' class='button-add button-modal' data-toggle='modal' data-target='#user-modal' data-method='add' data-agency-id='" + agencyId + "' data-user-id=''>Add contact</button>";
    if (!$.isEmptyObject(contacts)) {
        var contactCounter = 0;
        contactsSection += "<div><h4 style='background-color: lightgray; padding: 3px'>Contacts</h4>";
        contactsSection += "<table class='table'>" +
            "<thead>" +
            "<tr>" +
            "<th scope='col'>#</th>" +
            "<th scope='col'>Full Name</th>" +
            "<th scope='col'>Email</th>" +
            "<th scope='col'>Phone</th>" +
            "<th scope='col'>Edit</th>" +
            "<th scope='col'>Delete</th>" +
            "    </tr>" +
            "  </thead>" +
            "  <tbody>";
        $.each(contacts, function (indexUser, contact) {
            contactCounter++;
            contactsSection += "<tr>" +
                "<th scope='row'>" + contactCounter + "</th>" +
                "<td>" + contact.first_name + " " + contact.last_name + "</td>" +
                "<td>" + contact.email + "</td>" +
                "<td>" + contact.phone_number + "</td>" +
                "<td><button type='button' class='button-add button-modal' data-toggle='modal' data-target='#user-modal-edit' data-method='edit' data-agency-id='" + agencyId + "' data-user-id='" + contact.id + "'>Edit</button></td>" +
                "<td><button type='button' class='button-delete button-modal' data-toggle='modal' data-target='#user-modal-delete'  data-method='delete' data-agency-id='" + agencyId + "' data-user-id='" + contact.id + "'>Delete</button></td>" +
                "</tr>";
        });
        contactsSection += "</tbody></table></div>";

    }
    return contactsSection;
}

function getAgency(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/api/agencies/" + id,
        type: 'GET',
        dataType: "JSON",
        success: function (agency) {
            var agencyContactsWrapper = $("#agency-contacts");
            var name = $("#name_agency").val(agency.name);
            var city = $("#city_agency option[value='" + agency.city_id + "']").prop('selected', true);
            var address = $("#address_agency").val(agency.address);
            var email = $("#email_agency").val(agency.email);
            var web = $("#web_agency").val(agency.web);
            var phone = $("#phone_agency").val(agency.phone_number);
            var buttonAddContacts =  $("#add-submit");
            buttonAddContacts.attr("data-agency-id", agency.id);
            agencyContactsWrapper.addClass("agency-" + agency.id);
            agencyContactsWrapper.html(agencyContactsSection(agency.users,agency.id));
        }
    });
}

function saveAgency(method) {

    $('#agency_submit').click(function (e) {

        e.preventDefault();
        if (method == "add" || $.isNumeric(method)) {
            if (method == "add") {
                var requestType = "POST";
                var url = "/api/agencies";
            } else if ($.isNumeric(method)) {
                var requestType = "PUT";
                var url = "/api/agencies/" + method;

            }
            var name = $("#name_agency").val();
            var city = $("#city_agency").val();
            var address = $("#address_agency").val();
            var email = $("#email_agency").val();
            var web = $("#web_agency").val();
            var phone = $("#phone_agency").val();

            var contactOptions = $('#users_agency option:selected');
            var selected = [];
            $(contactOptions).each(function(index, contact){
                selected.push($(this).val());
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                type: requestType,
                data: {
                    "csrf-token": "{{ csrf_token() }}",
                    name: name,
                    city_id: city,
                    address: address,
                    email: email,
                    web: web,
                    phone_number: phone,
                    users: selected
                },
                dataType: "JSON",
                success: function (data) {
                    if(requestType == "PUT"){
                        window.location.replace("/admin/agency/" + method);
                    }else if(requestType == "POST"){
                        window.location.replace("/admin/agency/" + data.id);
                    }

                }
            });
        } else {
            alert("Invalid request");
        }
    })
}

function manageModals(selectedButton) {

    var button = $(selectedButton);
    var userMethod = button.attr("data-method");
    var userAgencyId = button.attr("data-agency-id");
    var userId = button.attr("data-user-id");
    if(userMethod == 'add' || userMethod == 'edit' || userMethod == 'delete') {
        var modal;
        if(userMethod == 'add'){
            modal = $("#user-modal button[type=submit]");
        }else if(userMethod == 'edit'){
            modal = $("#user-modal-edit button[type=submit]");
            editUser(userId);
        }else if(userMethod == 'delete'){
            modal = $("#user-modal-delete button[type=submit]");
        }
        modal.attr("data-method",userMethod);
        modal.attr("data-agency-id",userAgencyId);
        modal.attr("data-user-id",userId);
    }

}

function editUser(userId){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/api/users/' + userId,
        type: 'GET',
        dataType: "JSON",
        success: function (user) {
            // $('#user-modal').modal('hide');
            var firstName = $("#first_name_user_edit").val(user.first_name);
            var lastName = $("#last_name_user_edit").val(user.last_name);
            var email = $("#email_user_edit").val(user.email);
            var web = $("#web_user_edit").val(user.web);
            var phone = $("#phone_user_edit").val(user.phone_number);
            // var password = $("#password_user_edit").val(user.password);
        }
    });

}

function manageAgencyUser() {

    $('.user_submit').click(function (e) {
        var button = $(this);
        var userMethod = button.attr("data-method");
        var userAgencyId = button.attr("data-agency-id");
        var userId = button.attr("data-user-id");

        if(userMethod == 'add' || userMethod == 'edit' || userMethod == 'delete') {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            if (userMethod == "edit") {

                $.ajax({
                    url: "/api/users/" + userId,
                    type: "PUT",
                    data: {
                        "csrf-token": "{{ csrf_token() }}",
                        first_name: $("#first_name_user_edit").val(),
                        last_name: $("#last_name_user_edit").val(),
                        agency_id: userAgencyId,
                        email: $("#email_user_edit").val(),
                        web: $("#web_user_edit").val(),
                        phone_number: $("#phone_user_edit").val()
                    },
                    dataType: "JSON"
                });
            } else if (userMethod == 'delete') {
                $.ajax({
                    url: "/api/users/" + userId,
                    type: "DELETE",
                    dataType: "JSON"
                });
            }else{
                $.ajax({
                    url: "/api/users",
                    type: "POST",
                    data: {
                        "csrf-token": "{{ csrf_token() }}",
                        first_name: $("#first_name_user").val(),
                        last_name: $("#last_name_user").val(),
                        agency_id: userAgencyId,
                        email: $("#email_user").val(),
                        web: $("#web_user").val(),
                        phone_number: $("#phone_user").val(),
                        password: $("#password_user").val()
                    },
                    dataType: "JSON"
                });
            }

            var agencyWrap = $(".agency-" + userAgencyId);


            $.ajax({
                url: '/api/agencies/contacts/' + userAgencyId,
                type: 'GET',
                dataType: "JSON",
                success: function (users) {
                    $(".close").click();
                    agencyWrap.html(agencyContactsSection(users,userAgencyId));
                    // alert('Uspesan ' + userMethod);
                }
            });
        }

    })

}
