<?php 

$connection = mysqli_connect("localhost", "root", "", "review_php-dasar-waifu");

function query($query){
    global $connection;
    $result = mysqli_query($connection, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

?>