<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../config/Logger.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

$result = $company->read();

$num = $result->rowCount();

if ($num > 0) {
    $company_arr = array();
    $company_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $company_item = array(
            'id' => $id,
            'company_name' => $company_name,
            'add_date' => $add_date,
            'mod_date' => $mod_date,
            'logo' => $logo
        );

        array_push($company_arr['data'], $company_item);
    }
    Logger::show_logs('Read all companies');
    echo json_encode($company_arr);
} else {
    Logger::show_logs('Error company read');
    echo json_encode(
        array('message' => 'No company found')
    );
}
