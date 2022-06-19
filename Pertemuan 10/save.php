<?php

include 'koneksi.php';

$$allowed_extension = array('png', 'jpg', 'jpeg');
$name = $_FILES['file']['name'];
$x = explode('.', $name);
$extension = strtolower(end($x));
$size = $_FILES['file']['size'];
$file_temp = $_FILES['file']['tmp_name'];

if (in_array($extension, $allowed_extension) === true) {
    if ($size < 1044070) {
        move_uploaded_file($file_temp, 'file/' . $name);
        $query = mysqli_query($konek, "insert into mahasiswa values ('" . $_POST['nim'] . "','"
            . $_POST['nama'] . "','" . $_POST['prodi'] . "','" . $name . "');");
        if ($query) {
            echo '<script type="text/javascript">
                    alert("Data Berhasil Disimpan");
                    window.location.href = "index.php";
                </script>';
        } else {
            echo '<script type="text/javascript">
                    alert("Data Gagal Disimpan");
                    window.location.href = "index.php";
                </script>';
        }
    } else {
        echo '<script type="text/javascript">
            alert("Ukuran file melebihi batas maksimum");
            window.location.href = "index.php";
        </script>';
    }
} else {
    echo '<script type="text/javascript">
            alert("Extension file tidak diperbolehkan");
            window.location.href = "index.php";
        </script>';
}
