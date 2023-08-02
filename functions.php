<?php

$connection = mysqli_connect("localhost", "root", "", "review_php-dasar-waifu");

function query($query)
{
    global $connection;
    $result = mysqli_query($connection, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function create($data)
{
    global $connection;

    $nama = htmlspecialchars($data['nama']);
    $usia = htmlspecialchars($data['usia']);
    $image = htmlspecialchars($data['image']);
    $source = htmlspecialchars($data['source']);

    $query = "INSERT INTO waifus
                VALUES 
                ('', '$nama', '$usia','$image','$source')";

    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}

function destroy($id)
{
    global $connection;
    mysqli_query($connection, "DELETE FROM waifus WHERE id = $id");
}
