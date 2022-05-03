<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<nav class="bar-top-menu">
  <ul class="top-menu">
  <?php
	  $menu = '2';
	  $args        = array(
		'order'       => 'ASC',
		'orderby'     => 'menu_order',
		'post_type'   => 'nav_menu_item',
		'post_status' => 'publish',
		'output'      => ARRAY_A,
		'output_key'  => 'menu_order',
		'nopaging'    => true,
		);
		$items=wp_get_nav_menu_items( $menu, $args);
   //echo "<pre>";
 // print_r($items);
    foreach( $items as $item ){
    //  echo "<pre>";
   // print_r($item);
   ?>  
   <?php
    $has_child = false;
    foreach ($items as $check) {
      if ($check->menu_item_parent == $item->ID) {
          $has_child = true;
          }
          } ?>
    <?php if($item->menu_item_parent == 0) { ?>
    <li class="<?php echo ($has_child == true)?>"><a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
    <?php if ($has_child == true) { ?>
      <ul>
      <?php foreach ($items as $citem) {
          if ($citem->menu_item_parent == $item->ID) { ?>
        <li><a href="<?php echo $citem->url; ?>"><?php echo $citem->title; ?></a>
        <ul>
          <?php foreach($items as $child){
            if($child->menu_item_parent == $citem->ID){ ?>
               <li><a href="<?php echo $child->url; ?>"><?php echo $child->title; ?></a>
          <?php
          }
        }?> 
         <ul>
                <li><a href="#">Summer</a></li>
        </ul>     
        </ul>
      </li>
        <?php }
        } ?>   
      </ul>
        <?php } ?>
        </li>
      <?php } ?>
    <?php } ?>
  </ul>
</nav>


<?php
/**wp_nav_menu( array( 
    'theme_location' => 'primary', 
    'container_class' => 'custom-menu-class' ) ); */
?>