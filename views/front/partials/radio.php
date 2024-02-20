<?php 
/**
 * Radio group template
 * 
 * @var bool   $required
 * @var string $label
 * @var string $class_name
 * @var string $name
 * @var bool   $access
 * @var array  $values
 * 
 * @see wp-content/plugins/mattforms/app/Controllers/Front/Shortcode.php
 */
?>

<div class="radio-group">
    <?php foreach ( $values as $value ) { ?>
        <label>
            <input <?php echo $value->selected ? 'checked' : '' ?> type="radio" name="<?php echo esc_attr( $name ) ?>" value="<?php echo $value->value ?>">

            <?php echo esc_html( $value->label ) ?>
        </label>
    <?php } ?>
</div>