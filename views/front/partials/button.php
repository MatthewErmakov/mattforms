<?php 
/**
 * Button template
 * 
 * @var bool   $required
 * @var string $label
 * @var string $class_name
 * @var string $name
 * @var string $access
 * @var string $multiple
 * @var string $value
 * 
 * @see wp-content/plugins/mattforms/app/Controllers/Front/Shortcode.php
 */
?>

<div class="button">
    <button
        <?php echo $class_name !== '' ? sprintf( 'class="%s"', $class_name ) : '' ?>
        <?php echo $required ? 'required' : '' ?>
        <?php echo $name !== '' ? sprintf( 'name="%s"', $name ) : '' ?>
        <?php echo $subtype !== '' ? sprintf( 'type="%s"', $subtype ) : '' ?>
        <?php echo $value !== '' ? sprintf( 'value="%s"', $value ) : '' ?>
    ><?php echo $label !== '' ? $label : '' ?></button>
</div>