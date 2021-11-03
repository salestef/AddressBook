function getAgencies() {
    var agencyWrapper = $(".agency-wrapper");
    var agenciesSection = '';
    $.ajax({
        url: "/api/agencies",
        type: 'GET',
        dataType: "JSON",
        success: function (agencies) {
            $.each(agencies, function (index, agency) {
                console.log(agency);
                agenciesSection += "<div class='agency-card'>";
                agenciesSection += "<h2 style='border-bottom: 1px solid saddlebrown;'><a class='default-link' href='/admin/agency/" + agency.id + "'>" + agency.name + "</a></h2>";
                agenciesSection += "<b>City:</b><p>" + agency.city.name + "</p>";
                agenciesSection += "<b>Country:</b><p>" + agency.city.country.name + "</p>";
                agenciesSection += "<b>Email:</b><p>" + agency.email + "</p>";
                agenciesSection += "<b>Web:</b><p>" + agency.web + "</p>";
                agenciesSection += "<b>Phone:</b><p style='margin-bottom: 40px'>" + agency.phone_number + "</p>";
                if (!$.isEmptyObject(agency.users)) {
                    var contactCounter = 0;
                    agenciesSection += "<div><h4 style='background-color: lightgray; padding: 3px'>Contacts</h4>";
                    agenciesSection += "<table class='table'>" +
                        "<thead>" +
                        "<tr>" +
                        "<th scope='col'>#</th>" +
                        "<th scope='col'>Full Name</th>" +
                        "<th scope='col'>Role</th>" +
                        "<th scope='col'>Email</th>" +
                        "<th scope='col'>Phone</th>" +
                        "    </tr>" +
                        "  </thead>" +
                        "  <tbody>";
                    $.each(agency.users, function (indexUser, contact) {
                        contactCounter++;
                        agenciesSection += "<tr>" +
                            "<th scope='row'>" + contactCounter + "</th>" +
                            "<td>" + contact.first_name + " " + contact.last_name + "</td>" +
                            "<td>" + contact.role + "</td>" +
                            "<td>" + contact.email + "</td>" +
                            "<td>" + contact.phone_number + "</td>" +
                            "</tr>";
                    });
                    agenciesSection += "</tbody></table></div>";

                }
                agenciesSection += "</div><hr>";
            });
            agencyWrapper.html(agenciesSection);
        }
    });
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
            var name = $("#name_agency").val(agency.name);
            var city = $("#city_agency option[value='" + agency.city_id + "']").prop('selected', true);
            var address = $("#address_agency").val(agency.address);
            var email = $("#email_agency").val(agency.email);
            var web = $("#web_agency").val(agency.web);
            var phone = $("#phone_agency").val(agency.phone_number);
            if (!$.isEmptyObject(agency.users)) {
                $.each(agency.users, function (indexUser, contact) {
                    $("#users_agency option[value='" + contact.id + "']").prop('selected', true);
                });
            }

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
