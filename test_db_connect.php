<?php
$host = '103.108.220.15';
$user = 'zbncijdu_main';
$pass = '6**)OU]PWApx';
$db = 'zbncijdu_tool_main';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = 9353;
// Prefix is w999_ according to .env but we also have ab_ in some places, 
// let's just query w999_services or ab_services.
// The user's code says ServiceModel, let's query both.
$sql = "SELECT * FROM w999_services WHERE id = $id";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    echo "Found in w999_services:\n";
    print_r($result->fetch_assoc());
} else {
    $sql2 = "SELECT * FROM ab_services WHERE id = $id";
    $result2 = $conn->query($sql2);
    if ($result2 && $result2->num_rows > 0) {
        echo "Found in ab_services:\n";
        print_r($result2->fetch_assoc());
    } else {
        echo "No service found with ID $id\n";
    }
}
$conn->close();
?>
