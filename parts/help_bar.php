<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
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
		'taxonomy' => array(
			'tag_utmaningar',
			'tag_experter',
			'tag_diagnoser',
			'tag_ovrigt'
		),
		'slug' => array(
			'motorik',
			'sociala-relationer',
			'sprakstorning',
			'somn-problem',
			'utbrott-och-kanslor',
			'vardagsrutiner',
			'hemmasittare',
		),
		'orderby' => 'description'
	);
	$terms = get_terms($term_args);

	// slug
	$tagsToShow = array(
		'hemmasittare',
		'motorik',
		'sociala-relationer',
		'sprakstorning',
		'somn-problem',
		'utbrott-och-kanslor',
		'vardagsrutiner',
	);

	?>

	<div class="help-close"><span>Stäng</span></div>

	<div class="container">
		<div class="row">

			<div class="mob-helper" id="mobHelper">
				<h3>Visa resultat</h3>	
			</div>

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
							<label data-type="<?= $term->taxonomy; ?>" data-term="<?= $term->slug; ?>"><?= $term->name; ?></label>
						</li>	
					<?php endforeach ?>
				</ul>	
			</div>
			<div class="col-lg-6">
				<h3>Situationer</h3>
				<ul class="cat">
					<li>
						<label class="checkbox-container active" data-cat="">Alla situationer</label>
					</li>
					<?php foreach ($categories as $category):?>
						<li>
							<label class="checkbox-container" data-cat="<?= $category->slug; ?>"><?= $category->name; ?></label>
						</li>
					<?php endforeach ?>
				</ul>	
			</div>


		</div>
		<div class="loader">
			<div class="line"></div>
		</div>
		<div class="help-results">
			<div class="row">
			</div>
		</div>
		<div class="more">
			<div class="row">
				<div class="col-12">
					<a class="show-more" data-url="<?= get_site_url(); ?>" href="">
						<h3 class="show-more-text"> Visa mer</h3>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>