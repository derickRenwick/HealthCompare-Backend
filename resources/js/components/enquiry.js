// Submitting and validating the private hospital enquiry form
$(document).ready(function () {

    // Create jquery datepicker from DOB input
    $("#dateOfBirth").datepicker({
        changeMonth: true,
        changeYear: true,
        // minDate: "-100Y",
        // maxDate: "0Y",
        yearRange: "-100:-0",
        dateFormat: "dd/mm/yy",
        altField: "#actualDate",
        altFormat: "yy/mm/dd",
        setDate: "-0d"
    });

    // Add a custom validation to the jquery validate object - validate phone number field as UK format
    $.validator.addMethod('phoneUK', function (phone_number, element) {
            return this.optional(element) || phone_number.length > 9 &&
                phone_number.match(/^(\(?(0|\+44)[1-9]{1}\d{1,4}?\)?\s?\d{3,4}\s?\d{3,4})$/);
        }, 'Please specify a valid phone number'
    );

    // $.validator.addMethod("dateFormat", function(date) {
    //         // put your own logic here, this is just a (crappy) example
    //         return date.match(/^\d\d\d\d?\/\d\d?\/\d\d$/);
    //     },
    //     "Please enter a date in the format yyyy/mm/dd."
    // );

    $.validator.addMethod("dateFormat", function (date) {
            // Match the basic structure required - date also has to match dateISO
            return date.match(/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/);
        },
        "Please enter a date in the format dd/mm/yyyy."
    );

    $.validator.addMethod("alpha", function (value, element) {
            return value.match(/^[a-zA-Z\s]*$/);
        },
        "Please enter only alphabetical characters"
    );

    // Get form
    var $form = $('#enquiry_form');

    // Only run if the page contains the enquiry form
    if ($form.length > 0) {

        // jquery validate options
        $form.validate({
            rules: {
                hospital_id: {
                    required: true
                },
                title: "required",
                firstName: {
                    required: true,
                    alpha: true
                },
                lastName: {
                    required: true,
                    alpha: true
                },
                dob: { // The entered date
                    required: true,
                    dateFormat: true,
                },
                date_of_birth: { // The proxy date that is submitted to the backend
                    required: true,
                    dateISO: true
                },
                email: {
                    required: true,
                    email: true
                },
                confirm_email: {
                    required: true,
                    equalTo: email,
                    email: true
                },
                phone_number: {
                    required: true,
                    phoneUK: true
                },
                postcode: {
                    required: true,
                    postcodeUK: true
                },
                procedure_id: "required",
                gdpr: "required"
            },
            messages: {
                hospital_id: "There is no hospital id specified",
                title: "Please select your title",
                firstName: "Please enter your first name",
                lastName: "Please enter your surname",
                // date_of_birth: "Please enter your date of birth",
                email: "Please enter a valid email address",
                confirm_email: "The passwords entered do not match",
                phone_number: "Please enter your contact number",
                postcode: "Please enter a valid UK postcode",
                procedure_id: "Please select the procedure required",
                gdpr: "Please confirm you consent to our terms and conditions"
            },
            errorPlacement: function (error, element) {
                var customError = $([
                    '<span class="invalid-feedback d-block">',
                    '  <span class="mb-0 d-block">',
                    '  </span>',
                    '</span>'
                ].join(""));

                // Add `form-error-message` class to the error element
                error.addClass("form-error-message");

                // Insert it inside the span that has `mb-0` class
                error.appendTo(customError.find("span.mb-0"));

                // Insert your custom error
                customError.insertBefore(element);
            },
            // Submit handler - what happens when form submitted
            submitHandler: function () {
                // Create an FormData object
                var data = new FormData($form[0]);

                // If you want to add an extra field for the FormData
                // data.append("CustomField", "This is some extra data, testing);

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
                        // alert('Thanks, your enquiry has been submitted');
                        $('#hc_modal_enquire_private').modal('hide');
                        $('.alert')
                            .find('.alert-text')
                            .html('Thank you ' + data.data.first_name + ', your enquiry has been successfully sent!')
                            .parents('.alert')
                            .removeClass('alert-danger')
                            .addClass('alert-success show')
                            .show();
                        // Scroll to alert bar
                        $('html, body').animate({
                            scrollTop: ($('#hc_alert').offset().top)
                        }, 800);
                    },
                    error: function (e) {
                        var errorMsg = JSON.parse(e.responseText).errors.error;
                        console.log("ERROR : ", errorMsg, "status text: ", e.statusText);
                        $('.alert')
                            .find('.alert-text')
                            .html(errorMsg)
                            .parents('.alert')
                            .removeClass('alert-success')
                            .addClass('alert-danger show')
                            .show();
                        // Scroll to alert bar
                        $('html, body').animate({
                            scrollTop: ($('#hc_alert').offset().top)
                        }, 400);
                    }
                });
            }
        })
    }

    // Send the form on click of the button
    $('#btn_submit').on('click', function (e) {
        e.preventDefault();
        $(this)
            .parents('form')
            .submit();
    })

    // Dismiss bootstrap alert
    $("[data-hide]").on("click", function () {
        $(this).closest("." + $(this).attr("data-hide")).slideUp();
    });
});

