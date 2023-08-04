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
    $source = htmlspecialchars($data['source']);
    $image = upload();
    if (!$image) {
        return false;
    }


    $query = "INSERT INTO waifus
                VALUES 
                ('', '$nama', '$usia','$image','$source')";

    mysqli_query($connection, $query);

    return mysqli_affected_rows($connection);
}

function upload()
{
    $name = $_FILES['image']['name'];
    $size = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $tmpName = $_FILES['image']['tmp_name'];

    // cek apakah gambar sudah diupload

    if ($error === 4) {
        echo "<script>
                alert('Gambar belum diupload!');
            </script>";
        return false;
    }

    // cek apakah file yang diupload adalah gambar
    $valid = ['jpg', 'jpeg', 'png'];
    $extension = explode('.', $name);
    $extension = strtolower(end($extension));
    if (!in_array($extension, $valid)) {
        echo "<script>
            alert('Yang anda upload bukan gambar');
        </script>";
        return false;
    }

    if ($size > 10000000) {
        echo "<script>
            alert('ukuran gambar terlalu besar!');
        </script>";
        return false;
    }

    $newName = uniqid() . '.' . $extension;

    move_uploaded_file($tmpName, 'img/' . $newName);
    return $newName;
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
    $source = htmlspecialchars($data['source']);
    $oldImage = $data['oldImage'];

    if ($_FILES['image']['error'] === 4) {
        $image = $oldImage;
    } else {
        $image = upload();
    }

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
