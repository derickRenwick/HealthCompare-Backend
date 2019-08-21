// $(document).ready(function () {
//     // Submit enquiry to private hospital
//     var $enquiry_form = $('#enquiry_form')
//     $enquiry_form.on('submit',function(e) {
//         e.preventDefault();
//         $.ajax({
//             url: 'api/enquiry',
//             type: 'POST',
//             headers: {
//                 'Authorization':  'Bearer mBu7IB6nuxh8RVzJ61f4',
//             },
//             dataType: "json",
//             contentType: "application/json; charset=utf-8",
//             data: {'hospital_id': '1'},
//             success: function (data) {
//                 alert('Thanks for your enquiry')
//             },
//             error: function (data) {
//                 alert('Something went wrong! Please try again.')
//             },
//         });
//     });
// });

$(document).ready(function () {

    $("#btn-submit").click(function (event) {

        //stop submit the form, we will post it manually.
        event.preventDefault();

        // Get form
        var form = $('#enquiry_form')[0];

        // Create an FormData object
        var data = new FormData(form);

        // If you want to add an extra field for the FormData
        // data.append("CustomField", "This is some extra data, testing");

        // disabled the submit button
        $("#btn-submit").prop("disabled", true);

        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "/api/enquiry",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
            headers: {
                'Authorization': 'Bearer mBu7IB6nuxh8RVzJ61f4',
            },
            success: function (data) {
                alert('Thanks, your enquiry has been submitted');
                $('#hc_modal_enquire_private').modal('hide');
                $("#result").text(data);
                console.log("SUCCESS : ", data);
                $("#btn-submit").prop("disabled", false);

            },
            error: function (e) {
                alert(e.responseText);
                // $("#result").text(e.responseText);
                console.log("ERROR : ", e);
                $("#btn-submit").prop("disabled", false);

            }
        });

    });

});