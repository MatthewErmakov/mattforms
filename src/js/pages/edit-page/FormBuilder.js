import "formBuilder";

jQuery( function ( $ ) {
    $( document ).ready( function () {
        const fbTemplate = document.querySelector('.form-builder-inner');
        const formBuilderForm = $('.form-builder-form');

        let formData = formBuilderForm.find('input[name="fields"]').val();

        formData = {
            formData: atob( formData.replace(/-/g, "+").replace(/_/g, "/") )
        };;
    
        if ( ! formData ) {
           formData = {
            formData: ''
           };
        } 

        let jQfbTemplate = $( fbTemplate );

        /**
         * Waiting for formBuilder initialization
         * then assign on DOM element modification action
         * and get data
         * 
         * it's done to avoid error "Form Builder is still initializing"
         */
        let formBuilder = jQfbTemplate.formBuilder( formData ).promise.then(formBuilder => {
            jQfbTemplate.on( 'DOMSubtreeModified', function () {
                formData = formBuilder.actions.getData();
            } );
        });;

        let buttonSave = $('button.save-form');

        buttonSave.click( function ( e ) {
            e.preventDefault();

            let formTitle = formBuilderForm.find('input[name="form_title"]').val();
            let authorId = formBuilderForm.find('input[name="author_id"]').val();
            let formId = formBuilderForm.find('input[name="form_id"]').val();

            if ( formTitle !== '' ) {
                $.ajax({
                    method: 'POST',
                    url: mattforms.ajax_url,
                    data: {
                        action: 'matt_save_form',
                        nonce: mattforms.nonce,
                        formId: formId,
                        fields: JSON.stringify( formData ),
                        authorId: authorId,
                        formTitle: formTitle
                    },
        
                    success: function ( response ) {
                        $('#wpwrap').append( '<div class="form-saved-popup">Form saved</div>' );
                        
                        setTimeout( function () {
                            $('.form-saved-popup').remove();
                        }, 2000 );
                    },
        
                    error: function (e) {
                        console.log(e);
                    }
        
                });
            } else {
                $('#wpwrap').append('<div class="form-error-popup">Title field is required.</div>');
                
                setTimeout( function () {
                    $('.form-error-popup').remove();
                }, 2000 );
            }
        } );
    } );
} );