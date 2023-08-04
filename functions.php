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

function update($data)
{
    global $connection;

    $id = $data['id'];
    $nama = htmlspecialchars($data['nama']);
    $usia = htmlspecialchars($data['usia']);
    $image = htmlspecialchars($data['image']);
    $source = htmlspecialchars($data['source']);

    $query = "UPDATE waifus SET 
                nama = '$nama',
                usia = '$usia',
                image = '$image',
                source = '$source' 

                WHERE id = $id
    ";

    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}

function cari($keyword)
{
    $query = ("SELECT * FROM waifus WHERE
                nama LIKE '%$keyword%' OR
                usia LIKE '%$keyword%' OR
                source LIKE '%$keyword%'
                
            ");
    return query($query);
}
