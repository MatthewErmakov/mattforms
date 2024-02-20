<?php 
/**
 * @var 
 * @var bool   $required
 * @var string $label
 * @var string $description
 * @var string $placeholder
 * @var string $class_name
 * @var string $name
 * @var bool   $multiple
 */
?>

<div class="file">
    <label>
        <span><?php echo $label ?></span>

        <input 
            type="file"
            <?php echo $class_name !== '' ? sprintf( 'class="%s"', $class_name ) : '' ?>
            <?php echo $name !== '' ? sprintf( 'name="%s"', $name ) : '' ?>
            <?php echo $placeholder !== '' ? sprintf( 'placeholder="%s"', $placeholder ) : '' ?>
            <?php echo $multiple !== '' ? 'multiple="multiple"' : '' ?>
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
