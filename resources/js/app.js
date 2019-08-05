/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */



require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
$( document ).ready(function() {
    // Output time (year) dynamically
    var date = new Date();
    var thisyear = date.getFullYear();
    $('#thisYear').text(thisyear);

    //Hide first option tag value from displaying in select element options
    // $('.firstOption').hide();

    //BACK TO TOP SCRIPT
    //SCROLL EFFECT
    // Select all links with hashes
    $('a[href*="#"]')
    // Remove links that don't actually link to anything
        .not('[href="#"]')
        .not('[href="#0"]')
        .click(function (event) {
            // On-page links
            if (
                location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                &&
                location.hostname == this.hostname
            ) {
                // Figure out element to scroll to
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                // Does a scroll target exist?
                if (target.length) {
                    // Only prevent default if animation is actually gonna happen
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top
                    }, 500, function () {
                        // Callback after animation
                        // Must change focus!
                        var $target = $(target);
                        $target.focus();
                        if ($target.is(":focus")) { // Checking if the target was focused
                            return false;
                        } else {
                            $target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
                            $target.focus(); // Set focus again
                        }
                        ;
                    });
                }
            }
        }); //end of scroll


    //POSTCODE Autocomplete
    $('.postcode-autocomplete-cont').hide();
    $('.homePostCodeParent #input_postcode').on('input',function(e) {
        var postcode = $(this).val();
        $.ajax({
            url: 'api/getLocations/'+postcode,
            type: 'GET',
            headers: {
                'Authorization':  'Bearer mBu7IB6nuxh8RVzJ61f4',
            },
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            data: {},
            success: function (data) {
                // var json_obj = $.parseJSON(data);//parse JSON
                var ajaxBox = $(".homePostCodeParent .postcode-autocomplete-cont .ajax-box");
                ajaxBox.empty(); // remove old options
                //Check if we have at least one result in our data
                if(!$.isEmptyObject(data.data.result)) {
                    $.each(data.data.result, function(key, obj) { //$.parseJSON() method is needed unless chrome is throwing error.
                        ajaxBox.append("<p class='postcode-item' >"+ obj.postcode +"</p>");
                    });
                    $('.postcode-autocomplete-cont').show();
                } else {
                    alert('Invalid Postcode! Please try again.');
                }
            },
            error: function (data) {
                alert('Something went wrong! Please try again.')
            },
        });
    });

    $('.ajax-box').on('click', '.postcode-item', function(){
        var newPostcode = $(this).text();
        var parent      = $('.homePostCodeParent #input_postcode');
        var ajaxBox     = $('.postcode-autocomplete-cont .ajax-box');
        parent.val(newPostcode);
        ajaxBox.empty();
        $('.postcode-autocomplete-cont').hide();
    });

    //COMPARE FUNCTIONALITY
    //Check if we don't have the cookie and set it to 0
    var compareBar = $('.compare-hospitals-bar');
    if (typeof Cookies.get("compareCount") === 'undefined') {
        Cookies.set("compareCount", 0, {expires: 10000});
        Cookies.set("compareHospitalsData", JSON.stringify([{}]), {expires: 10000});
    }

    // Cookies.set("compareCount", 0, -1);
    // Cookies.set("compareHospitalsData", 0, -1);
    // Cookies.set("compareCount", 0, {expires: 10000});
    // Cookies.set("compareHospitalsData", JSON.stringify([{}]), {expires: 10000});

    //Check if we need to show the Compare hospitals div
    if(Cookies.get("compareCount") > 0) {
        compareBar.show();
    } else {
        compareBar.hide();
    }

    function addObjectToArray(object, array) {

    }

    function removeObjectFromArray(object, array) {

    }

    //Set the OnClick event for the Compare button
    $(document).on("click touchend", ".sortCatSection3 .compare", function () {
        //Check if there are already 3 hospitals for comparison in Cookies
        var compareCount = parseInt(Cookies.get("compareCount"));
        //Get the Data that is already in the Cookies
        var data = JSON.parse(Cookies.get("compareHospitalsData"));

        //Load the Cookies with the data that we need for the comparison
        var elementId = $(this).attr('id');
        var name = $('#name_'+elementId).text();
        var waitingTime = $('#waiting_time_'+elementId).text();
        var userRating = $('#user_rating_'+elementId).text();
        var opCancelled = $('#op_cancelled_'+elementId).text();
        var qualityRating = $('#quality_rating_'+elementId).text();
        var ffRating = $('#ff_rating_'+elementId).text();
        var nhsFunded = $('#nhs_funded_'+elementId).text();

        var result = $.grep(data, function(e){ return e.id == elementId; });

        if(compareCount < 3) {

            if (result.length === 0) {
                // no result found, add the data to the cookies
                data.push({
                    'id': elementId,
                    'name': name,
                    'waitingTime': waitingTime,
                    'userRating': userRating,
                    'opCancelled': opCancelled,
                    'qualityRating': qualityRating,
                    'ffRating': ffRating,
                    'nhsFunded': nhsFunded
                });
                compareCount = parseInt(compareCount) + 1;
            } else if (result.length === 1) {
                // property found, access the foo property using result[0].foo
                data = $.grep(data, function(e){
                    return e.id != elementId;
                });
                compareCount = parseInt(compareCount) - 1;
            } else {
                // multiple items found
            }
        } else {
            if (result.length === 1) {
                // property found, access the foo property using result[0].foo
                data = $.grep(data, function(e){
                    return e.id != elementId;
                });
                compareCount = parseInt(compareCount) - 1;
            }
        }

        //Reset compareCount and compareHospitalsData
        Cookies.set("compareCount", 0, -1);
        Cookies.set("compareHospitalsData", 0, -1);
        //Set them back again
        Cookies.set("compareHospitalsData", JSON.stringify(data), {expires: 10000});
        Cookies.set("compareCount", compareCount, {expires: 10000});
        console.log(compareCount);
        console.log(data);
    });
});
