<?php

include("../initialize.php");

$district = NULL;
$sector = NULL;
if (isset($_GET['district'])) {
    $district = $_GET['district'];
}
if (isset($_GET['sector'])) {
    $sector = $_GET['sector'];
}

// Fetch state list by Province
if (isset($district)) {

    $output = "<option value=''>Select District</option>";
    $province = Rwanda::find_district_by_procinve($district);
    foreach ($province as $p) {
        $output .= "<option value='" . $p->id . "'>" . $p->Name . "</option>";
    }
    echo $output;
    exit;
}

// Fetch city list by District
if (isset($sector)) {
    $output = "<option value=''>Select Sector</option>";
    $district = Rwanda::find_sector_by_district($sector);
    foreach ($district as $d) {
        $output .= "<option value='" . $d->id . "'>" . $d->Name . "</option>";
    }
    echo $output;
    exit;
}