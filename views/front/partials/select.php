<?php
/**
 * Select values
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

<div class="select">
    <label>
        <span><?php echo $label ?></span>
        <select 
            <?php echo $name !== '' ? sprintf( 'name="%s"', $name ) : '' ?>
            <?php echo $class_name !== '' ? sprintf( 'class="%s"', $class_name ) : '' ?>
            <?php echo $required !== '' ? 'required' : '' ?>
        >
            <?php foreach ( $values as $value ) { ?>
                <option <?php echo $value->selected ? 'selected' : '' ?> value="<?php echo $value->value ?>">
                    <?php echo esc_html( $value->label ) ?>
                </option>
            <?php } ?>
        </select>
    </label>
</div>