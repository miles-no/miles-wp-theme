<?php
/**
 * Template part for displaying individual consultant page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package miles
 */
    $cv = get_query_var('cv');
    $name = $cv["name"];
	$email = null/* $cv["email"] */;
	$phone = null/* $cv["telephone"] */;
	$rol = $cv["title"]["no"];
	$firstCategory = $cv["office"]["name"];
	$image = $cv["image"]["url"];
	$keyQualifications = $cv["key_qualifications"];

	$summary = null;
    //Lookup summary with label == miles.no
	foreach ($keyQualifications as $qualification) {
		if (strtolower($qualification['label']['no']) == "miles.no" ) {
			$summary = $qualification['long_description']['no'];
			break;
		}
		else if (strtolower($qualification['label']['int']) == "miles.no" ){
			$summary = $qualification['long_description']['int'];
			break;
		}
	}
?>

<main id="primary" class="site-main">
	<section class="menneskene type-menneskene status-publish format-standard hentry">
		<header class="person-header">
			<div class="person-meta-data">
				<div class="name">
					<?php echo $name; ?>
				</div>
				<div class="title-location">
					<?php echo $rol . ($firstCategory ? ', ' . $firstCategory : ''); ?>
				</div>
				<div class="email">
					<?php echo $email; ?>
				</div>
				<div class="phone">
					<?php echo $phone; ?>
				</div>
			</div>

		</header><!-- .entry-header -->

		<?php $thumbnail = (!empty($image)) ? $image : '/wp-content/themes/miles/image/female.png'; ?>
		<figure class="person-thumbnail" style="background-image: url('<?php echo $thumbnail; ?>');">
		</figure>

		<div class="entry-content">
			<p>
				<?php echo $summary; ?>
			</p>
		</div><!-- .entry-content -->

		</article><!-- #post -->
</main><!-- #main -->