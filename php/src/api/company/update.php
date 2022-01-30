<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../config/Logger.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

$data = json_decode(file_get_contents("php://input"));

$company->id = $data->id;

$company->company_name = $data->company_name;
//$company->modification_date = $data->modification_date;
//$company->logo = $data->logo;

if ($company->update()) {
    Logger::show_logs('Update company info');
    echo json_encode(
        array('message' => 'Data updateted')
    );
} else {
    Logger::show_logs('Error company update');
    echo json_encode(
        array('message' => 'Error')
    );
}