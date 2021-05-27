jQuery(document).ready(function($) {
    /*
     * General settings for ajax requests, sending to the server csrf-token
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /*
     * Show and hide catalog menu items in the left column
     */
    $('#catalog-sidebar > ul ul').hide();
    $('#catalog-sidebar .badge').on('click', function () {
        var $badge = $(this);
        var closed = $badge.siblings('ul') && !$badge.siblings('ul').is(':visible');
        if (closed) {
            $badge.siblings('ul').slideDown('normal', function () {
                $badge.children('i').removeClass('fa-plus').addClass('fa-minus');
            });
        } else {
            $badge.siblings('ul').slideUp('normal', function () {
                $badge.children('i').removeClass('fa-minus').addClass('fa-plus');
            });
        }
    });
    /*
     * Getting user profile data at checkout
     */
    $('form#profiles button[type="submit"]').hide();
    //when choosing a profile, we send an ajax request to get data
    $('form#profiles select').change(function () {
        //if the item "Select profile"
        if ($(this).val() == 0) {
            //clear all fields of the checkout form
            $('#checkout').trigger('reset');
            return;
        }
        var data = new FormData($('form#profiles')[0]);
        $.ajax({
            url: '/basket/profile',
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                $('input[name="name"]').val(data.profile.name);
                $('input[name="email"]').val(data.profile.email);
                $('input[name="phone"]').val(data.profile.phone);
                $('input[name="address"]').val(data.profile.address);
                $('textarea[name="comment"]').val(data.profile.comment);
            },
            error: function (reject) {
                alert(reject.responseJSON.error);
            }
        });
    });
    /*
     * Add item to basket using ajax request without reloading
     */
    $('form.add-to-basket').submit(function (e) {
        //cancel the form submission in the standard way
        e.preventDefault();
        //getting data of this form
        var $form = $(this);
        var data = new FormData($form[0]);
        $.ajax({
            url: $form.attr('action'),
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType: 'HTML',
            beforeSend: function () {
                var spinner = ' <span class="spinner-border spinner-border-sm"></span>';
                $form.find('button').append(spinner);
            },
            success: function(html) {
                $form.find('.spinner-border').remove();
                $('#top-basket').html(html);
            }
        });
    });
});
