<?php
/**
This file routes to the specific function depending on the HTTP verb *
 */
$request_method = strtoupper($_SERVER['REQUEST_METHOD']);
require_once($_SERVER['DOCUMENT_ROOT'] . '/config.php');
switch ($request_method) {
    case 'GET':
        // Retrieve User by Id
        if (!empty($_GET["id"])) {
            $id = intval($_GET["id"]);
            get_users($id);

        } else {
            get_users();
        }
        break;

    case 'POST':
        insert_users(file_get_contents('php://input'));
        break;
    case 'DELETE':
        $id =isset($_GET['id'])?intval($_GET['id']):0;
        delete_user($id);
        break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

/** Returns all users if no param provided or a specific user by id. Maps to /v1/users/{id}
 * @param int $id
 * @return void
 */
function get_users($id = 0)
{
    global $mysqli;

    $id = $mysqli->real_escape_string($id);

    $query = "SELECT c.*,group_concat(concat(cc.id,'_',cc.`active`, '_', cc.created_at ) )as certs FROM `customers` c LEFT JOIN customer_certificate cc on c.id=cc.customer_id";
    if ($id) {
        $query .= " WHERE c.id=" . $id . "";
    }

    $query .= "  GROUP BY c.id";

    $result = $mysqli->query($query);

    $response = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $response["data"][] = $row;

        }
        //give a 200 ok response status code
        $response["status"] = 200;
    } else {
        //hand out a 200 but give a message that no users found
        $response["data"] = [];
        $response["status"] = 200;
        $response["message"]="No users found";
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

/**  Creates new users. Maps to POST /v1/users
 * @param string $post
 * @return void
 */
function insert_users($post)
{

    global $mysqli;

    $post = json_decode($post, 1);

    $firstname = $mysqli->real_escape_string($post['firstname']);

    $lastname = $mysqli->real_escape_string($post['lastname']);

    $email = $mysqli->real_escape_string($post['email']);

    $password = $mysqli->real_escape_string($post['password']);

    //these fields are required and give out a 400 if either of them are empty
    if (!$firstname || !$lastname || !$email || !$password) {
        $response = array(
            'status' => 400,
            'message' => 'Bad request'
        );
        header('HTTP/1.1 400');
        echo json_encode($response);
        exit();
    }
    $length = 12;
    $encrypted_id = substr(str_shuffle(md5(time())), 0, $length);

    $salt = substr(str_shuffle(md5(time())), 0, 7);

    $hashpassword = md5($salt . $password) . ':' . $salt;

    $query = "INSERT INTO customers(first_name,last_name,email,encrypted_id,password)VALUES('$firstname','$lastname','$email','$encrypted_id','$hashpassword')";

    if ($mysqli->query($query)) {
        $response = array(
            'status' => 201,
            'message' => 'User Added Successfully.',
            'id'=>$mysqli->insert_id
        );
    } else {
        $response = array(
            'status' => 500,
            'message' => 'Internal server error'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

/** Deletes a user by looking up their id in the database. Maps to DELETE /v1/users/{id}
 * @param int $id
 * @return void
 */
function delete_user($id)
{
    global $mysqli;
    $id = $mysqli->real_escape_string($id);

    if ($id) {
        $query = "DELETE FROM `customers` WHERE `id`='$id'";
        $mysqli->query($query);
        if ($mysqli->affected_rows) {
            $response = array(
                'status' => 200,
                'message' => 'The resource was deleted successfully'
            );
            header('HTTP/1.1 200 OK');
            echo json_encode($response);
            exit();
        } else {
            $response = array(
                'status' => 404,
                'message' => 'The requested resource was not found on the server.'
            );
            header('HTTP/1.1 404 Not found');
            echo json_encode($response);
            exit();
        }

    } else {
        $response = array(
            'status' => 400,
            'message' => 'Bad request'
        );
        header('HTTP/1.1 400');
        echo json_encode($response);
        exit();
    }
}