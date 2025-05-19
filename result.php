<?php
include("connections.php");

if (empty($_GET["search"])) {
    // No search term provided, do nothing or handle accordingly
} else {
    $check = $_GET["search"];
    $terms = explode(" ", $check);
    $q = "SELECT * FROM mytbl WHERE ";
    $i = 0;

    foreach ($terms as $each) {
        $i++;
        if ($i == 1) {
            $q .= "(name LIKE '%$each%'";
        } else {
            $q .= " OR name LIKE '%$each%'";
        }
    }
    $q .= ")"; // Close the WHERE clause condition

    $query = mysqli_query($connection, $q);
    $c_q = mysqli_num_rows($query);

    if ($c_q > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            echo $row["name"] . "<br>";
        }
    } else {
        echo "No results found";
    }
}
?>