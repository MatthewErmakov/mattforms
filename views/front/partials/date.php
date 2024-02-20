<?php
/**
 * @var string $type
 * @var bool   $required
 * @var string $description
 * @var string $placeholder
 * @var string $class_name
 * @var string $name
 * @var bool   $access
 * @var string $subtype
 * @var int    $max_length
 */
?>

<div class="date"> 
    <label>
        <span><?php echo $label ?></span>
        <input 
            <?php echo $required !== 'required' ? '' : '' ?>
            <?php echo $placeholder !== '' ? sprintf( 'placeholder="%s"', $placeholder ) : '' ?>
            <?php echo $class_name !== '' ? sprintf( 'class="%s"', $class_name ) : '' ?>
            <?php echo $name !== '' ? sprintf( 'name="%s"', $name ) : '' ?>
            <?php echo $subtype !== '' ? sprintf( 'type="%s"', $subtype ) : '' ?>
            <?php echo $max !== '' ? sprintf( 'max="%d"', $max ) : '' ?>
            <?php echo $min !== '' ? sprintf( 'min="%d"', $min ) : '' ?>
            <?php echo $length !== '' ? sprintf( 'length="%d"', $length ) : '' ?>
        >
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