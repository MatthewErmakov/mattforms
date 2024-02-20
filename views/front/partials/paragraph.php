<?php 
/**
 * @var string  $subtype
 * @var string  $label
 * @var string  $class_name
 * @var boolean $access
 */
?>

<div class="paragraph">
    <<?php echo $subtype ?>
     <?php echo $class_name !== sprintf( 'class="%s"', $class_name ) ? '' : '' ?>
    >
        <?php echo $label ?>
    </<?php echo $subtype ?>>
</div>