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

$tax_args = array(
	// 'name' => array('tag_personer', 'tag_amnen')
	'public' => true
);
$tax_output = 'objects';
$tax = get_taxonomies($tax_args, $tax_output);
$taxies = array('tag_personer', 'tag_kanslor', 'tag_utmaningar', 'tag_amnen');

if ($tax) { ?>
<div class="tag-cloud-container">
	<div class="container">
		<div class="row">
			<div class="col-12">
				
				<?php 
				foreach ($tax as $single_tax) {

					if (in_array($single_tax->name, $taxies)) {
						$terms_args = array(
							'taxonomy' => $single_tax->name,
						);
						$all = get_terms($terms_args);
						?>
						<div class="tag-type">
							<h4><?= $single_tax->label; ?></h4>

							<?php
							foreach ($all as $single) { ?>
								<a href="<?= get_term_link($single); ?>" class="tag-cloud-link" style="font-size: 16px;"><?= $single->name; ?></a> <?php
							} ?>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php 
}
?>

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