<?php
$dbHost = 'localhost';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'codexworld';
//connect with the database
$db = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);
//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query = $db->query("SELECT * FROM skills WHERE skill LIKE '%".$searchTerm."%' ORDER BY skill ASC");
while ($row = $query->fetch_assoc()) {
    	$firstname = $row['skill'];
		$customercode= $row['id'];
		$a_json_row["id"] = $customercode;
		$a_json_row["label"] = $firstname;
}
//return json data
echo json_encode($a_json_row);
flush();
?>