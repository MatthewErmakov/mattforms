<?php 
/**
 * Hidden field template
 * 
 * @var string $name
 * @var string $value
 * @var bool   $access
 */
?>

<input type="hidden"
    <?php echo $name !== '' ? sprintf( 'name="%s"', $name ) : '' ?>
    <?php echo $value !== '' ? sprintf( 'value="%s"', $value ) : '' ?>
>