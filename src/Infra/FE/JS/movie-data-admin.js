jQuery( document ).ready( function( $ ) {

    "use strict";

    $( '#movie_data_form' ).submit( function( event ) {

        event.preventDefault();
        var movie_data_form = $("#movie_data_form").serialize();


        movie_data_form = movie_data_form+'&ajaxrequest=true&submit=Submit+Form';

        $.ajax({
            url:    params.ajaxurl, // wp-admin/admin-ajax.php
            type:   'post',
            data:   movie_data_form
        })

            .done( function( response ) {
                $(" #movie_data_form_feedback ").html( "<h2>The request was successful </h2><br>" + response );
            })


            .fail( function(request, error) {
                console.log(request.responseText);
                $(" #movie_data_form_feedback ").html( "<h2>Something went wrong</h2><br>" + request.responseText );
            })


            .always( function() {
                event.target.reset();
            });

    });

});