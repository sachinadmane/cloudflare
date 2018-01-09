jQuery(document).ready(function ($) {
    $.get('/users/index.php', function (data) {

        var response = jQuery.parseJSON(data);
        var html = "";
        for (var i = 0; i < response.length; i++) {
            var certs = response[i].certs ? response[i].certs.split(',') : [];

            html += "<tr id='" + response[i].id + "'>";
            html += "<td>" + response[i].first_name + "</td>";
            html += "<td>" + response[i].last_name + "</td>";
            html += "<td>" + response[i].email + "</td>";
            html += "<td>";
            for (var y = 0; y < certs.length; y++) {
                var active = certs[y].split('_')[1];
                var key = certs[y].split('_')[2];
                var cert_id = certs[y].split('_')[0];
                var link = active > 0 ? '<a id="' + cert_id + '"  class="toggle_certificate deactive_certificate"  href="javascript:void">Deactivate</a>' : '<a id="' + cert_id + '"' +
                    'class="toggle_certificate active_certificate" href="javascript:void">Activate</a>';
                html += "<li>";
                html += key;
                html += " ";
                html += link;
                html += "</li>";
            }
            html += "</td>";

            html += '<td><div class="btn-group pull-right"><button id="bCert" class="btn btn-sm btn-default">Certificate <i class="fa fa-plus"></i></button><button id="bElim" type="button" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-trash"> </span></div></td>';
            html += "</tr>";
        }

        $("#DyanmicTable tbody").append(html);

        var tbody = $("#DyanmicTable tbody");

        if (tbody.children().length == 0) {
            $("#DyanmicTable").hide();
        }
    });


    $(document).on("submit", "form.well", function (e) {

        e.preventDefault();

        var firstname = $("#first_name").val();

        var lastname = $("#last_name").val();

        var email = $("#email").val();

        var password = $("#user_password").val();

        if (!firstname || !lastname || !email || !password) {
            return false;
        }

        $.post("/users/add.php", {
            firstname: firstname,
            lastname: lastname,
            password: password,
            email: email,
            submit: 'submit'
        }, function (data) {


            var response = $.parseJSON(data);

            var id = response.id;

            $("#DyanmicTable").show();

            $('#DyanmicTable').append('<tr id="' + id + '">' +
                '<td>' + firstname +
                '</td>' + '<td>' + lastname +
                '</td>' + '<td>' + email + '</td>' + "<td></td>" + '<td name="buttons"><div class="btn-group pull-right"><button id="bCert" class="btn btn-sm btn-default">Certificate <i class="fa fa-plus"></i></button><button id="bElim" type="button" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-trash"> </span></div></td>');

        });
        $(document).find(':input:not([type=submit])').val('');
    });

    $(document).on("click", "#bElim", function () {

        var id = $(this).closest("tr").attr("id");

        var tbody = $("#DyanmicTable tbody");

        if (confirm("Are you sure you want to delete this customer?")) {

            $.ajax({

                type: 'DELETE',
                url: '/users' + '?' + $.param({"id": id}),
                success: function (result) {
                    var response = $.parseJSON(result);

                    if (response.status == true) {
                        $("#" + id).remove();
                    }
                }
            });
        }

        if (tbody.children().length == 1) {
            $("#DyanmicTable").hide();
        }

    });

    $(document).on('click', '.toggle_certificate', function () {
        var row_id = $(this).closest('tr').attr("id");
        var cert_id = $(this).attr("id");
        var self = $(this);
        var current_text = $(this).text();
        current_text = current_text.toLowerCase();
        var new_text = '';
        var new_class = '';
        var remove_class = '';
        if (current_text === 'activate') {
            new_text = 'Deactivate';
            new_class = 'deactive_certificate';
            remove_class = 'active_certificate';
        } else {
            new_text = 'Activate';
            new_class = 'active_certificate';
            remove_class = 'deactive_certificate';
        }
        $.post("/helper/data.php", {
            id: cert_id,
            submit: 'submit'
        }, function (data) {
            self.text(new_text);
            self.removeClass(remove_class);
            self.addClass(new_class);
        });

        return false;
    });


    $(document).on('click', '#bCert', function () {

        var cid = $(this).closest("tr").attr("id");
        var self = $(this);
        $.post("/helper/certificate.php", {
            id: cid,
            submit: 'submit'
        }, function (data) {

            var response = $.parseJSON(data);

            var cert_id = response.id;

            var active = response.active;

            var created_at = response.created_at;

            var link = active > 0 ? '<a id="' + cert_id + '" class="toggle_certificate deactive_certificate"  href="javascript:void">Deactivate</a>' : '<a id="' + cert_id + '" class="toggle_certificate active_certificate"  href="javascript:void">Activate</a>';
            self.closest("td").prev("td").append("<li>" + created_at + " " + link + "</li>");

        });

    });


});

