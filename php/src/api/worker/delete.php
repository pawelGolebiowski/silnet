<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../config/Logger.php';
include_once '../../models/Worker.php';

$database = new Database();
$db = $database->connect();

$worker = new Worker($db);

$data = json_decode(file_get_contents("php://input"));

$worker->id = $data->id;

if ($worker->delete()) {
    Logger::show_logs('Delete worker');
    echo json_encode(
        array('message' => 'Data Deleted')
    );
} else {
    Logger::show_logs('Error worker delete');
    echo json_encode(
        array('message' => 'Data Not Deleted')
    );
}