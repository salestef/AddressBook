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
                // agenciesSection += "<h2>Info agencije</h2>";
                agenciesSection += "<h2 style='border-bottom: 1px solid saddlebrown;'><a class='default-link' href='/admin/agency/" + agency.id +"'>" + agency.name + "</a></h2>";
                agenciesSection += "<b>City:</b><p>" + agency.city.name + "</p>";
                agenciesSection += "<b>Email:</b><p>" + agency.email + "</p>";
                agenciesSection += "<b>Web:</b><p>" + agency.web + "</p>";
                agenciesSection += "<b>Phone:</b><p style='margin-bottom: 40px'>" + agency.phone_number + "</p>";
                if(!$.isEmptyObject(agency.users)){
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
                    $.each(agency.users, function (indexUser,contact) {
                        contactCounter++;
                        agenciesSection += "<tr>" +
                            "<th scope='row'>" + contactCounter +"</th>" +
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

function saveAgency() {
    $('#agency_submit').click(function (e) {
        e.preventDefault();
        var name = $("#name_agency").val();
        var city = $("#city_agency").val();
        var address = $("#address_agency").val();
        var email = $("#email_agency").val();
        var web = $("#web_agency").val();
        var phone = $("#phone_agency").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "/api/agencies",
            type: 'POST',
            data: {
                "csrf-token": "{{ csrf_token() }}",
                name:name,
                city_id:city,
                address:address,
                email:email,
                web:web,
                phone_number:phone
            },
            dataType: "JSON",
            success: function( data ) {
                $('#agency-form').trigger("reset");
                alert('Success save');
            }
        });
    })


}
