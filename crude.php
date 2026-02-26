<?php 

require 'vendor/autoload.php'; 
use Ramsey\Uuid\Uuid;
include 'database.php';

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET'){
    
    $id = $_GET['id'] ?? null;
    // echo json_encode(['success' => true, 'id' => $id]); testing// 

    if($id) {
        $query = "SELECT * FROM \"user\".user_data WHERE id = $1";
        $result = pg_query_params($con, $query, [$id]);

        if ($result) {
            $row = pg_fetch_assoc($result);
            echo json_encode(['success' => true, 'data' => $row]);
        } else {
            echo json_encode(['success' => false, 'error' => pg_last_error($con)]);
        }

    } else {

        $query = "SELECT * FROM \"user\".user_data";
        $result = pg_query($con, $query);

        if($result){
            // $row = pg_fetch_assoc($result);
                $rows = [];
                while ($row = pg_fetch_assoc($result)) {
                    $rows[] = $row;
                }
            echo json_encode(['success' => true, 'data' => $rows]);
            
        }
    }
}


if($method == 'POST')
{
    $input = json_decode(file_get_contents('php://input'), true);

    $id = Uuid::uuid4()->toString();

    $query = "INSERT INTO \"user\".user_data (id, name, email, phone_number) VALUES ($1, $2, $3, $4)";
    $result = pg_query_params($con, $query, [$id, $input['name'], $input['email'], $input['phone_number']]);

    if ($result) {
        echo json_encode(['success'=>true,'id'=>$id]);
    } else {
        echo json_encode(['success'=>false,'error'=>pg_last_error($con)]);
    }
}


if($method == 'PUT')
{
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'] ?? null;

    if($id === null){
        echo json_encode(['success'=>false,'error'=>'id is required']);
        die();  
    }

    $query = "UPDATE \"user\".user_data SET name = $1, email = $2, phone_number = $3 WHERE id = $4";
    $result = pg_query_params($con, $query, [$input['name'], $input['email'], $input['phone_number'], $id]);

    if($result){
        echo json_encode(['success'=>true,'message'=>'data updated']);
    }
}


if($method == 'DELETE')
{
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $input['id'] ?? null;

    if($id === null){
        echo json_encode(['success'=>false,'error'=>'id is required']);
    die();
    }

    $query = "DELETE FROM \"user\".user_data WHERE id = $1";
    $result = pg_query_params($con, $query, [$id]);

    if($result){
        echo json_encode(['success'=>true,'message'=>'data deleted']);
    }
}

?>