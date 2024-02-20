<?php
/**
 * Checkbox group
 * 
 * @var bool $required
 * @var string $label
 * @var string $description
 * @var bool $inline
 * @var string $class_name
 * @var string $name
 * @var bool $access
 * @var bool $other
 * @var array $values
 */
?>

<div class="checkbox-group<?php echo $class_name !== '' ? ' ' . $class_name : '' ?>">
    <div class="label">
        <?php echo $label ?>
    </div>
    <div class="items">
    <?php foreach ( $values as $value ) { ?>
        <label>
            <input <?php echo $value->selected ? 'checked' : '' ?> type="checkbox" name="<?php echo esc_attr( $name ) ?>" value="<?php echo $value->value ?>">

            <span><?php echo esc_html( $value->label ) ?></span>
        </label>
    <?php } ?>
    <?php if ( $other ) { ?>
        <span class="other">
            <label id="other">
                <input type="checkbox" name="<?php echo esc_attr( $name ) ?>" value="other">
            
                <span>Other</span>
            </label>
            <span class="custom-value">
                <span>Enter your value</span>
                <input type="text" name="<?php echo esc_attr( $name ) ?>">
            </span>
        </span>
    <?php } ?>
    </div>
</div>