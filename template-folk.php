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

function page_not_found() {
	status_header(404);
	get_template_part('404');
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

if ($cv) {

	$cvObject = json_decode($cv, true);

	if ($cvObject['status'] == 404) {
		page_not_found();
		exit();
	}

	set_query_var('cv', $cvObject);
	get_template_part('template-parts/content-consultant');
	get_footer();
} else {
	page_not_found();
}