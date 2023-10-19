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
 * @package Miles_2023
 */
/* define( 'WP_DEBUG', true ); */
get_header();

function findEmployeeByName($name, $employees) {
  $nameParts = explode("-", $name); // Split the name into parts
  foreach ($employees as $employee) {
    $employeeName = $employee['name'];
    $found = true;
    foreach ($nameParts as $part) {
      if (stripos($employeeName, $part) === false) { // Check if the part is not found in the employee name
        $found = false;
        break;
      }
    }
    if ($found) {
      return $employee; // Return the employee if all parts are found in the name
    }
  }
  return $employees[0]; // Return the first element if no match is found
}

function format_query_vars()
{
	$employeeName = get_query_var('employeeName');
	$employeeName = str_replace('-', '+', $employeeName);
	return 'name=' . $employeeName;
}

// call our API (make sure API is set up in admin area)
$usersRes = wpgetapi_endpoint( 
	'cvpartner_miles_wordpress',
	'users_search',
	array(
		'debug' => false,
		'query_variables' => format_query_vars()
	)
);

$cv = null;

// if we have found users, get the full CV from the first user
// we assume that the first user is the best match
if ($usersRes && $usersRes != 'null') {

	$users = json_decode($usersRes, true);
	$userObject = findEmployeeByName(get_query_var('employeeName'), $users);

	$cv = wpgetapi_endpoint(
		'cvpartner_miles_wordpress',
		'get_full_cv',
		array(
			'debug' => false,
			'endpoint_variables' => array(
				'user_id' => $userObject["user_id"],
				'cv_id' => $userObject["default_cv_id"]
			)
		)
	);
}

if (!$cv || $cv == 'null') {
	echo 'No result. Ensure you have the API set up correctly following the guide here - https://wpgetapi.com/docs/quick-start-guide/';
} else {
	$cvObject = json_decode($cv, true);

	$name = $cvObject["name"];
	$email = null/* $cvObject["email"] */;
	$phone = null/* $cvObject["telephone"] */;
	$rol = $cvObject["title"]["no"];
	$firstCategory = $cvObject["office"]["name"];
	$image = $cvObject["image"]["url"];
	$keyQualifications = $cvObject["key_qualifications"];

	$enabledKeyQualification = [];

	if ($keyQualifications && count($keyQualifications) > 0) {
		$enabledKeyQualification = array_filter($keyQualifications, function ($keyQualification) {
			return $keyQualification["disable"] == false;
		});
	}

	$longDescription = null;

	if (count($enabledKeyQualification) > 0) {
		$enabledKeyQualification = $enabledKeyQualification[0];
		$longDescription = $enabledKeyQualification["long_description"]["no"];
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
					<?php echo $rol; ?>,
					<?php echo $firstCategory ?>
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
				<?php echo $longDescription; ?>
			</p>
		</div><!-- .entry-content -->

		</article><!-- #post -->
</main><!-- #main -->

<?php

get_footer();