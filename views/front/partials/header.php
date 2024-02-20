<?php 
/**
 * @var string $label
 * @var string $subtype
 * @var string $class_name
 */
?>

<div class="header">
    <<?php echo $subtype ?>
        <?php echo $class_name !== '' ? sprintf( 'class="%s"', $class_name ) : '' ?>
    >
        <?php echo $label ?>
    </<?php echo $subtype ?>>
</div>