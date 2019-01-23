<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
			<!-- <div class="filter-btn"> -->
			<div class="help-button">
				<h2>Hur kan vi hjälpa dig?</h2>
			</div>
		</div>
	</div>
</div>

<div id="helpOverlay" class="help-overlay">
	<?php
	$categories = get_categories();
	$term_args = array(
		'taxonomy' => 'post_tag'
	);
	$terms = get_terms($term_args);
	?>

	<div class="help-close"><span>Stäng</span></div>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="help-header">
					<h1>Hur kan vi hjälpa dig?</h1>
					<p>Mitt barn kämpar med...</p>
				</div>
			</div>


			<div class="col-lg-6">
				<h3>Beteenden/Utmaningar</h3>
				<ul class="term">
					<?php foreach ($terms as $term): ?>
						<li>
							<label data-term="<?= $term->slug; ?>"><?= $term->name;  ?></label>
						</li>
					<?php endforeach ?>
				</ul>	
			</div>
			<div class="col-lg-6">
				<h3>Situationer</h3>
				<ul class="cat">
					<?php foreach ($categories as $category):?>
						<li>
							<label class="checkbox-container" data-cat="<?= $category->slug; ?>"><?= $category->name; ?></label>
						</li>
					<?php endforeach ?>
				</ul>	
			</div>


		</div>
		<div class="help-results">
			<div class="row">
			</div>
		</div>
	</div>
</div>