<?php

namespace miles_limes;

function get_offices()
{
    $offices = json_decode(wpgetapi_endpoint('milesno_limes_internal_api', 'get_offices', array('debug' => false)), true);

    return $offices["list"] ?? array();
}

function get_consultants($office, $role, $email)
{
    $params = array();
    if ($office) {
        $params[] = "officeId=" . search_office($office);
    }
    if ($role) {
        $params[] = "role=" . $role;
    }
    if ($email) {
        $params[] = "email=" . $email;
    }
    $query = implode("&", $params);

    $consultantList = wpgetapi_endpoint(
        'milesno_limes_internal_api',
        'get_consultants',
        array(
            'debug' => false,
            'query_variables' => $query,
            'header_variables' => array(
                'Content-Type' => 'application/json; charset=utf-8'
            ),
        )
    );

    $consultants = json_decode($consultantList, true);

    return $consultants['list'] ?? array();
}

function search_office($officeName)
{
    $officeList = get_offices();

    foreach ($officeList as $office) {
        if (strtolower($office["name"]) == strtolower($officeName)) {
            return $office["officeId"];
        }
    }

    return $officeName;
}
