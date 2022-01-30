<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../config/Logger.php';
include_once '../../models/Company.php';

$database = new Database();
$db = $database->connect();

$company = new Company($db);

$data = json_decode(file_get_contents("php://input"));

$company->id = $data->id;

if ($company->delete()) {
    Logger::show_logs('Delete company');
    echo json_encode(
        array('message' => 'Data Deleted')
    );
} else {
    Logger::show_logs('Error company delete');
    echo json_encode(
        array('message' => 'Data Not Deleted')
    );
}
