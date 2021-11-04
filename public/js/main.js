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
                agenciesSection += agencyContactsSection(agency.users);
                agenciesSection += "</div><hr>";
            });
            agencyContactsWrapper.html(agenciesSection);
        }
    });
}

function agencyContactsSection(contacts){
    var contactsSection = "";
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
                "<td>Edit</td>" +
                "<td>Delete</td>" +
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
            agencyContactsWrapper.html(agencyContactsSection(agency.users));
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
                    alert('Success save');
                    if (requestType != "PUT") {
                        $('#agency-form').trigger("reset");
                    }
                }
            });
        } else {
            alert("Invalid request");
        }
    })
}
function manageAgencyUser() {

    $('.user_submit').click(function (e) {
        var button = $(this);
        var userMethod = button.attr("data-method");
        var userAgencyId = button.attr("data-agency-id");
        var userId = button.attr("data-user-id");
        if(userMethod == 'add' || userMethod == 'edit' || userMethod == 'delete') {
            if (userMethod == "edit") {
                var requestType = "PUT";
                var url = "/api/users/" + userId;
            } else if (userMethod == 'delete') {
                var requestType = "DELETE";
                var url = "/api/users/" + userId;
            }else{
                var requestType = "POST";
                var url = "/api/users";
            }

            var agencyWrap = $(".agency-" + userAgencyId);

            var firstName = $("#first_name_user").val();
            var lastName = $("#last_name_user").val();
            var email = $("#email_user").val();
            var web = $("#web_user").val();
            var phone = $("#phone_user").val();
            var password = $("#password_user").val();

            alert('cao');
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
                    first_name: firstName,
                    last_name: lastName,
                    agency_id: userAgencyId,
                    email: email,
                    web: web,
                    phone_number: phone,
                    password: password
                },
                dataType: "JSON"
            });

            $.ajax({
                url: '/agencies/users/' + userAgencyId,
                type: 'GET',
                dataType: "JSON",
                success: function (users) {
                    agencyWrap.html(agencyContactsSection(users));
                }
            });
        }

    })

}
