<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../config/Logger.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

$data = json_decode(file_get_contents("php://input"));
$company->company_name = $data->company_name;
//$company->logo = $data->logo;

if ($company->create()) {
    Logger::show_logs('Create company');
    echo json_encode(
        array('message' => 'Data created')
    );
} else {
    Logger::show_logs('Error company create');
    echo json_encode(
        array('message' => 'Error')
    );
}
