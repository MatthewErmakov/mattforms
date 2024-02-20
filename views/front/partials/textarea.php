<?php
/**
 * Textarea template
 * 
 * @var bool   $required
 * @var string $label
 * @var string $description
 * @var string $placeholder
 * @var string $class_name
 * @var string $name
 * @var bool   $access
 * @var int    $max
 * @var int    $rows
 * @var string $value
 * 
 * @see wp-content/plugins/mattforms/app/Controllers/Front/Shortcode.php
 */
?>

<div class="textarea">
    <label>
        <span><?php echo $label ?></span>
        <textarea
            <?php echo $name !== '' ? sprintf( 'name="%s"', $name ) : '' ?>
            <?php echo $class_name !== '' ? sprintf( 'class="%s"', $class_name ) : '' ?>
            <?php echo $max !== '' ? sprintf( 'maxlength="%d"', $max ) : '' ?>
            <?php echo $rows !== '' ? sprintf( 'rows="%d"', $rows ) : '' ?>
            <?php echo $required !== '' ? 'required' : '' ?>
        ><?php echo trim( $value ) ?></textarea>
    </label>

    <?php if ( $description !== '' ) { ?>
    <div class="question">
        ?
        <div class="hint">
            <?php echo $description ?>
        </div>
    </div>
    <?php } ?>
</div>