// Bootstrap modal
var $privateModal = $('#hc_modal_enquire_private');
// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
// Private enquiry form - show title of hospital clicked


$privateModal.on('show.bs.modal', function (event) {

    var $button = $(event.relatedTarget);// Button that triggered the modal
    // Pre-check the checkboxes
    if($button.hasClass('enquire-prices')){
        $('#reason_for_contact_price_range').prop('selected', true);
    } else if($button.hasClass('enquire-times')){
        $('#reason_for_contact_waiting_time_nhs_funded').prop('selected', true);
    }
    $('#info_text').text($button.data('modal-text'));

    var hospitalTitle   = $button.data('hospital-title');// Extract info from data-* attributes
    var modal           = $(this);
    // console.log(hospitalTitle);
    // var hospitalId      = $button.attr('id').replace('enquire_', '');
    var hospitalId      = $button.data('hospital-id');
    var picture         = $button.data('image');

    modal.find('.hospital-title').html(hospitalTitle);
    modal.find("input[name='hospital_id']").val(hospitalId);
    modal.find('.modal-enquire-private-image').attr("src", picture);

    // Add class to body
    $body.addClass('enquiry-form-open');
});

var $info = $('#col_additional_information');
// Clear form checkboxes inputs when closing modal
$privateModal.on('hide.bs.modal', function (event) {
    // empty checkbox
    $(this)
        .find('input[type=checkbox]')
        .prop('checked', false);

    // Clear text inputs
    $(this)
        .find('input[type=text]')
        .val('');

    // Close the info box and empty contents
    $info
        .find('textarea')
        .val('');

    var validator = $( "#hc_modal_enquire_private" ).validate();
    validator.resetForm();
});

// Toggle the additional info box when clicking on the 'other' checkbox
$('#other').on('click', function(){

    $info.toggleClass('open');
    // if($("#other").is(':checked')) {
    //     $info.addClass()
    // }
});

// Mobile event handling of the private enquiry form
$('#hc_modal_mobile_enquire_private').on('show.bs.modal', function (event) {
    // Close other modals that are open
    // console.log($(this));
    $('.modal')
        .modal('hide');
});

// Remove the body class
$('#hc_modal_mobile_enquire_private, #hc_modal_enquire_private').on('hide.bs.modal', function (event) {
    $body.removeClass('enquiry-form-open');
    handleFormReset();
});

