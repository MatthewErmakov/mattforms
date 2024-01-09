jQuery( function ( $ ) {
    $(document).ready(function() {
        $('.shortcode_input').click(function() {
            var textToCopy = $( this ).val();
            var tempTextarea = $('<textarea>');

            let parent = $( this ).parent();

            if ( parent.find( '.matt_copied_caption' ).length === 0 ) {
                parent.append( '<span class="matt_copied_caption">Copied!</span>' );
            }

            $('body').append(tempTextarea);
            tempTextarea.val(textToCopy).select();
            document.execCommand('copy');
            tempTextarea.remove();

            setTimeout(() => {
                parent.find( '.matt_copied_caption' ).remove();
            }, 1500);
        });
    });
} );