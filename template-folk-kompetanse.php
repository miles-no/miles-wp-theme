<?php
/**
 * Template Name: Folk Kompetanse Template
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

/**
 * FUNCTIONS
 */
include_once "miles_limes.php";
include_once "shortcode_util.php";

$MAX_RESULT_SIZE = 100;

function resolvedQueryParameters()
{
    $query = $_SERVER['QUERY_STRING'];
    parse_str($query, $parsedQuery);
    return $parsedQuery;
}

/************************ END FUNCTIONS ********************************* */

get_header();

global $wp;
$current_url = home_url($wp->request);

$custom_tags = array(
    'Arkitektur' => 'ARCHITECTURE',
    'Data Science' => 'DATA_SCIENCE',
    'Design' => 'DESIGN',
    'Prosjektledelse' => 'PROJECT_MANAGEMENT',
    'Rådgivning' => 'ADVISORY',
    'Smidig' => 'AGILE',
    'Testledelse' => 'TEST_MANAGEMENT',
    'Utvikling' => 'DEVELOPMENT'
);

$content = get_the_content();
$title = get_the_title();

$norwegian_offices = miles_limes\get_offices();
//arguments are: office, role, email
$consultants = miles_limes\get_consultants(null, null, null);

$parsedQuery = resolvedQueryParameters();
$selected_office = $parsedQuery['office'] ?? null;
$selected_role = $parsedQuery['area'] ?? null;

$offices = array();
foreach ($norwegian_offices as $office) {
    $selected = $selected_office && $selected_office == $office['officeId'];
    $offices[] = array(
        'selected' => $selected,
        'href' => $selected ? $current_url : $current_url . "?office=" . $office['officeId'],
        'officeId' => $office['officeId'],
        'class' => $selected ? "class='selected'" : null,
        'name' => $office['name']
    );
}
usort($offices, fn($a, $b) => strcmp($a['name'], $b['name']));

$roles = array();
foreach ($custom_tags as $roleKey => $roleId) {
    $selected = $selected_role == $roleId;
    $roles[] = array(
        'selected' => $selected,
        'href' => $selected ? $current_url : $current_url . "?area=" . $roleId,
        'roleId' => $roleId,
        'class' => $selected ? "class='selected'" : null,
        'name' => $roleKey
    );
}


    $result = '';

    foreach ($consultants as $consultant) {
        $hidden = false;
    
        if ($selected_office) {
            $hidden = $consultant['officeId'] != $selected_office;
        } elseif ($selected_role) {
            $hidden = !in_array($selected_role, $consultant['roles']);
        }
    
        $result .= shortcode_util\toWebComponent('miles-profile-card', consultant_as_webcomponent($consultant, $hidden), null);
    }
    

function consultant_as_webcomponent( $consultant, $hidden ): array {
	return array(
        'name'         => $consultant["name"],
        'location'     => $consultant["office"],
        'jobtitle'     => $consultant["title"],
        'image'        => $consultant["imageUrlThumbnail"],
        'email'        => $consultant["email"],
        'phone'        => $consultant["telephone"],
        'roles'        => implode(',', $consultant["roles"]),
        'officeId'     => $consultant['officeId'],
        'class'        => $hidden ? "class='hidden'" : null,
        'preloadimage' => true,
	);
}

?>
    <main id="primary" class="site-main our_people">
        <h1><?php echo $title; ?></h1>
        <?php echo $content; ?>
        <div class="miles_offices_bar cv-filter-tags" aria-description="Våre kontor i Norge." aria-label="Kontor">
            <span>Kontor</span>
            <ul>
                <li>
                    <miles-filter-button filter="" color="#3F1221" href="<?php echo $current_url; ?>">Alle</miles-filter-button>
                </li>
                <?php foreach ($offices as $office): ?>
                    <li <?php echo $office["class"] ?>>
                        <miles-filter-button filter="<?php echo $office['officeId']; ?>" <?php echo $office["selected"] ? 'selected' : '' ?> color="#3F1221"
                                             href="<?php echo $office['href']; ?>"><?php echo ucfirst($office['name']); ?></miles-filter-button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="miles_areas_bar cv-filter-tags" aria-description="Hva vi er gode på." aria-label="Fagområder">
            <span>Fagområder</span>
            <ul>
                <li>
                    <miles-filter-button filter="" color="#3F1221" href="<?php echo $current_url; ?>">Alle</miles-filter-button>
                </li>
                <?php foreach ($roles as $role): ?>
                    <li <?php echo $role["class"] ?>>
                    <miles-filter-button filter="<?php echo $role['roleId']; ?>" <?php echo $role["selected"] ? 'selected' : '' ?> color="#3F1221"
                                             href="<?php echo $role['href']; ?>"><?php echo ucfirst($role['name']); ?></miles-filter-button >
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <section class="cv-filter">
            <?php 
                echo $result;
                //echo do_shortcode('[show-consultant-group office="' . $selected_office . '" area="' . $selected_role . '" wc_name="miles-profile-card"]'); 
            ?>
        <miles-filter></miles-filter>
        </section>
    </main>
    <!-- #main -->
    <section class="prefooter">
        <miles-info>Vi finner den perfekte konsulenten for deg og ditt prosjekt!</miles-info>
        <div class="prefooter__fade"></div>
    </section>
<?php get_footer(); ?>
