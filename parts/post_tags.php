<?php

$post_id = get_the_ID();
$category_object = get_the_category($post_id);
$category_name = $category_object[0]->name;

if(empty($category_object)):
	// do nothing
else: ?>
	<div class="cat-tag">
		<strong>Kategori: </strong>
		<div class="tags">
			<span class="underline tag-buttons"><?php echo the_category(' '); ?></span>
		</div>
	</div>
<?php endif;





$tag_arr = array('tag_utmaningar', 'tag_experter', 'tag_diagnoser', 'tag_ovrigt');

foreach ($tag_arr as $tag) {
	$terms = wp_get_post_terms($post->ID, $tag);

	if ($terms) { ?>
		<div class="cat-tag">
			<strong><?= get_taxonomy($tag)->label ?>:</strong>
			<div class="tags">
				<?php 
				foreach ($terms as $term) { ?>
					<a class="tag-cloud-link" href="<?= get_term_link($term); ?>"><?= $term->name; ?></a>
					<?php
				}?>
			</div>
		</div>
		<?php
	}	
}



?>