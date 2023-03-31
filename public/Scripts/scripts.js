
    let baseurl = '<?= base_url()?>';

    function getPersonenAjax(params) {
    $.ajax({
        type: "POST",
        url: baseurl + "/test/getpersonenajax",
        data: {
            search: params.data.search
        },
        dataType: "json",
        success: function (data) {
            params.success({
                "rows": data,
                "total": data.length
            })
        },
        error: function (er) {
            params.error(er);
        }
    });
    }

    function BearbeitenFormatter(value, row) {
    let divcode = '<div class="btn-group">' +
    '<button class="btn"' +
    'onclick="javascript:OpenPersonenModal(' + row.MitgliedID + ',1);">' +
    '<i class="fas fa-edit text-primary"></i>' +
    '</button>' +
    '<button class="btn"' +
    'onclick="javascript:OpenPersonenModal(' + row.MitgliedID + ',2);">' +
    '<i class="fas fa-trash text-primary"> </i>' +
    '</button>' +
    '</div>';

    return divcode;
    }

    function OpenPersonenModal(id, todo) {
    $.ajax({
        type: "POST",
        url: baseurl + "/test/getTest",
        data: {
            id: id
        },
        dataType: "json",
        success: function (data) {
            document.getElementById('mitgliedID').value = data.MitgliedID;

            document.getElementById('username').value = data.Benutzername;
            document.getElementById('email').value = data.EMail;
            document.getElementById('password').value = data.Passwort;
        },
        error: function (error) {
            // Nichts
        }
    });

    $('#example').modal();
    }