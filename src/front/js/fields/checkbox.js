jQuery( function ( $ ) {
    $('#other input').change( function () {
        if ( this.checked ) {
            $('.custom-value').show();
        } else {
            $('.custom-value').hide();
        }
    } );

    $('.checkbox-group input[type="checkbox"]').click( function () { 
        const checkboxes = $(this).closest('.items').find('input[type="checkbox"]'); // Select all checkboxes
  
        for ( const checkbox of checkboxes ) {
            if ( checkbox.checked === true ) {
                checkbox.checked = false; // Uncheck selected boxes
            } else {
                checkbox.checked = true; // Check unselected boxes
            }
        }
    });
} );