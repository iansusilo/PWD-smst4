<?php

include 'koneksi.php';

$allowed_extension = array('png', 'jpg', 'jpeg');
$name = $_FILES['file']['name'];
$x = explode('.', $name);
$extension = strtolower(end($x));
$size = $_FILES['file']['size'];
$file_temp = $_FILES['file']['tmp_name'];

if (in_array($extension, $allowed_extension) === true) {
    if ($size < 1044070) {
        //delete file lama
        $pic_lama = mysqli_query($konek, "select foto from mahasiswa where nim = '" . $_POST['nim'] . "';");
        $foto_lama = mysqli_fetch_array($pic_lama)['foto'];

        if (strlen($foto_lama) > 0) {
            if (file_exists('file/' . $foto_lama)) {
                unlink('foto/' . $foto_lama);
            }
        }

        move_uploaded_file($file_temp, 'file/' . $name);
        $query = mysqli_query($konek, "update mahasiswa set nama = '" . $_POST['nama'] . "', prodi = '" . $_POST['prodi'] . "', foto = '" . $nama . "' where nim = '" . $_POST['nim'] . "';");
        if ($query) {
            echo '<script type="text/javascript">
                    alert("Data tersimpan");
                    window.location.href = "index.php";
                </script>';
        } else {
            echo '<script type="text/javascript">
                    alert("Data gagal tersimpan");
                    window.location.href = "index.php";
                </script>';
        }
    } else {
        echo '<script type="text/javascript">
            alert("Ukuran file terlalu besar");
            window.location.href = "index.php";
        </script>';
    }
} else {
    echo '<script type="text/javascript">
            alert("Eks file tidak diperbolehkan");
            window.location.href = "index.php";
        </script>';
}
