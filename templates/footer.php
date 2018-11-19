<?php 
$args = array(
	'smallest'                  => 16, 
	'largest'                   => 16,
	'unit'                      => 'px', 
	'number'                    => 0,  
	'format'                    => 'flat',
	'separator'                 => ' ',
	'orderby'                   => 'name', 
	'order'                     => 'RAND',
	'exclude'                   => null, 
	'include'                   => null,
	'link'                      => 'view', 
	'taxonomy'					=> array( 'post_tag', 'extra' ),
	'echo'                      => true,
	'child_of'                  => null, // see Note!
);
?>

<div class="tag-cloud-container">
	<div class="container">
		<div class="row py-5 my-5">
			<div class="col-12">
				<h4 id="taggar" class="pb-3">Taggar</h4>
				<?php wp_tag_cloud($args) ?>
			</div>
		</div>
	</div>
</div>

<footer>
	<div class="container">
		<div class="row">
			<div class="col-12 col-md-4">
		        <nav>
		            <?php wp_nav_menu(['menu' => 'sidfot', 'menu_class' => 'nav']); ?>
		        </nav>
				<div class="newsletter"><a href="https://urplay.se/nyhetsbrev?" aria-label="UR Nyhetsbrev" target="_blank">Prenumerera på UR:s nyhetsbrev för föräldrar</a></div>
			</div>
			<div class="col-12 col-md-4">
			</div>
			<div class="col-12 col-md-4">
				<?php dynamic_sidebar('sidebar-footer'); ?>
			</div>
		</div>
	</div>
</footer>