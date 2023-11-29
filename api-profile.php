<?php  
require_once "koneksi.php";
if (function_exists($_GET['function'])) {
	$_GET['function']();
}

function get_profile(){
	global $koneksi;
	$query = $koneksi->query("SELECT * FROM tb_user");
	while ($row=mysqli_fetch_object($query)) {
		$data[] = $row;
	}
	$response=array(
		'status'=> 1,
		'message' => 'Success',
		'data' => $data);
	header('Content-Type: application/json');
	echo json_encode($response);
}

function get_profile_id(){
	global $koneksi;
	if (!empty($_GET["id"])) {
		$id = $_GET["id"];
	}
	$query = "SELECT * FROM tb_user WHERE id = '$id'";
	$result = $koneksi->query($query);
	while ($row = mysqli_fetch_object($result)) {
		$data[] = $row;
	}
	if ($data) {
		$response = array(
			'status'=> 1,
			'message' => 'Success',
			'data' => $data);
	}else {
		$response = array(
			'status'=> 0,
			'message' => 'No Data Found');
	}
	header('Content-Type: application/json');
	echo json_encode($response);
}

function update_profile() {
    global $koneksi;

    if (!empty($_GET["id"]) && !empty($_GET["nama"]) && !empty($_GET["email"]) && !empty($_GET["password"]) && !empty($_GET["no_hp"])) {
        $id = $_GET["id"];
        $nama = $_GET["nama"];
        $email = $_GET["email"];
        $password = $_GET["password"];
        $no_hp = $_GET["no_hp"];

        // Prepared statement untuk menghindari SQL injection
        $query = "UPDATE tb_user SET nama = ?, email = ?, password = ?, no_hp = ? WHERE id = ?";
        $stmt = mysqli_prepare($koneksi, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'ssssi', $nama, $email, $password, $no_hp, $id);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $response = array(
                    'status' => 1,
                    'message' => 'Update Success'
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => 'Update Failed'
                );
            }
        } else {
            $response = array(
                'status' => 0,
                'message' => 'Query Prepare Failed'
            );
        }

        mysqli_stmt_close($stmt);
    } else {
        $response = array(
            'status' => 0,
            'message' => 'Missing Parameters'
        );
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}

update_profile();
?>