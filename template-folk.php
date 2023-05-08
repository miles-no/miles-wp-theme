<?php
/**
 * Template Name: Folk List Template 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Miles_2020
 */
define( 'WP_DEBUG', true );
get_header();

// call our API (make sure API is set up in admin area)
$user = wpgetapi_endpoint( 'cvpartner_miles_wordpress', 'user_by_email',
	array(
		'debug' => false,
		'query_variables' => 'email=espen.sjovoll@miles.no'
	)
);

if( ! $user || $user == 'null' ) {

	echo 'No result. Ensure you have the API set up correctly following the guide here - https://wpgetapi.com/docs/quick-start-guide/';

} else { 
	wpgetapi_pp($user);
	var_dump(wpgetapi_pp($user));

	$userObject = json_decode($user, true);

	$selectedUserAtttributes = [
		"company_id" => $userObject["company_id"],
		"user_id" => $userObject["user_id"],
		"_id" => $userObject["_id"],
		"email" => $userObject["email"],
		"default_cv_template_id" => $userObject["default_cv_template_id"],
		"image" => $userObject["image"]["large"]["url"],
		"name" => $userObject["name"],
	];
}

?>

	<main id="primary" class="site-main">

		<h3><?php echo $selectedUserAtttributes["email"]; ?></h3>
		<img src="<?php echo $selectedUserAtttributes["image"]; ?>" alt="" />
	</main><!-- #main -->

<?php

get_footer();

