<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../config/Logger.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

$company->id = isset($_GET['id']) ? $_GET['id'] : die();

$company->get_single_company();

$company_arr = array(
    'id' => $company->id,
    'company_name' => $company->company_name,
    'add_date' => $company->add_date,
    'mod_date' => $company->mod_date,
    'logo' => $company->logo,
);

Logger::show_logs('Read One Company');
print_r(json_encode($company_arr));