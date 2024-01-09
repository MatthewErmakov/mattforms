<?php
/**
 * Edit form template
 */
?>

<form class="wrap form-builder-form">
    <h1 class="wp-heading-inline">
        <?php if ( $id !== 0 ) { ?>
        Edit form #<?php echo esc_html( $id ) ?>
        <?php } else { ?>
        New form
        <?php } ?>
    </h1>

    <div id="titlediv">
        <div id="titlewrap">
	        <label class="screen-reader-text" id="title-prompt-text" for="title">Add title</label>
	        <input placeholder="Enter form name" value="<?php echo $title ?>" type="text" name="form_title" size="30" value="" id="title" spellcheck="true" autocomplete="off">
        </div>
    </div>

    <div class="container">
        <div class="form-builder">
            <div class="form-builder-inner">
                
            </div>
        </div>

        <div class="form-saver">
            <div class="form-saver-inner">
                <button class="save-form">Save form</button>
            </div>
        </div>
    </div>

    <input type="hidden" name="fields" value=<?php echo base64_encode( json_encode( $fields ) )  ?>>
    <input type="hidden" name="form_id" value="<?php echo esc_attr( $id ) ?>">
    <input type="hidden" name="author_id" value="<?php echo esc_attr( $author_id ) ?>">
</form>