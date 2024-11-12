
<?php
session_start();
if(!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    if(!empty($_GET['jabatan'])) {
        $id = antiinjection($koneksi, $_GET['id']);
        $query = "DELETE FROM jabatan WHERE id = '$id'";
        if(mysqli_query($koneksi, $query)) {
            pesan('success', "Jabatan berhasil dihapus");
        } else {
            pesan('danger', "Hapus Jabatan gagal. " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=jabatan");
    }else if(!empty($_GET['anggota'])) {
        $id = antiinjection($koneksi, $_GET['id']);
        $query = "DELETE FROM anggota WHERE id = '$id'";
        if(mysqli_query($koneksi, $query)) {
            $query2 = "DELETE FROM user WHERE id = '$id'";
            if(mysqli_query($koneksi, $query2)) {
            pesan('success', "Anggota berhasil dihapus");
            } else {
                pesan('warning', "Data login terhapus Tetapi data anggota tidak terhapus. " . mysqli_error($koneksi));
            }
        } else{
            pesan('danger', "Anggota Tidak Terhapus Karena. " . mysqli_error($koneksi));
        }
        header("Location: ../index.php?page=anggota");
    }
}

?>
