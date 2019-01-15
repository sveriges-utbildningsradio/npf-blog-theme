<div class="container">
	<div class="row justify-content-center">
		<div class="col-12 col-md-8">
			<div class="filter-btn">
				<h2>Hur kan vi hjälpa dig då</h2>
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

	<div class="help-close"></div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="help-header">
					<h1>Hur kan vi hjälpa dig?</h1>
					<p>Sök på vårt innehåll</p>
				</div>
			</div>


			<div class="col-6">
				<ul>
					<?php foreach ($terms as $term): ?>
						<li>
							<label class="checkbox-container"><?= $term->name;  ?>
								<input type="checkbox">
								<span class="checkmark"></span>
							</label>
						</li>
					<?php endforeach ?>
				</ul>	
			</div>
			<div class="col-6">
				<ul>
					<?php foreach ($categories as $category):?>
						<li>
							<label class="checkbox-container"><?= $category->name; ?>
								<input type="checkbox">
								<span class="checkmark"></span>
							</label>
						</li>
					<?php endforeach ?>
				</ul>	
			</div>
		</div>
	</div>
</div>