// Busque una forma sencilla de hacer esto con JS pero no lo encontré
// larga vida JQuery y ChatGPT
jQuery(function($) {
    // Escucha el evento ajaxComplete para manejar la solicitud después de la eliminación
    $(document).ajaxComplete(function(event, xhr, settings) {

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url, // Ruta de admin-ajax.php definido en las funciones php
            data: {
                action: 'update_count_cart'
            },
            success: function(response) {
                // Actualiza el contenido del contador con la respuesta del servidor
                $('#cart-num-items').html(response);

                // Restaura el estado de eliminandoProducto
                eliminandoProducto = false;
            }
        });
    })

});
