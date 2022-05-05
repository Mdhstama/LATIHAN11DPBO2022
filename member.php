<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");
include("includes/Author.class.php");
include("includes/Member.class.php");

$member = new Member($db_host, $db_user, $db_pass, $db_name);
$member->open();

if (isset($_POST['submit'])) {
    if (isset($_GET['id_edit'])) {
        $member->update($_GET['id_edit']);
        header("location:member.php");
        exit;
    } else {
        $member->getDetail($_POST['nim']);
        if ($member->getResult() == NULL) {
            $member->add();
        } else {
            echo "<script>
            alert('NIM sudah terdaftar, silahkan masukan nim yang lain');
        </script>";
        }
    }
}

if (isset($_GET['id_edit'])) {
    $member->getDetail($_GET['id_edit']);
    while (list($nim, $name, $jurusan) = $member->getResult()) {
        $update_nim = $nim;
        $update_name = $name;
        $update_jur = $jurusan;
    }
}

if (isset($_GET['id_delete'])) {
    $member->delete($_GET['id_delete']);
    header("location:member.php");
    exit;
}

$member->getMember();
$data = null;
$no = 1;

while (list($nim, $name, $jurusan) = $member->getResult()) {
    $data .= "<tr>
                <td>" . $no++ . "</td>
                <td>" . $nim . "</td>
                <td>" . $name . "</td>
                <td>" . $jurusan . "</td>
                <td>
                    <a href='member.php?id_edit=" . $nim .  "' class='btn btn-warning' '>Edit</a>
                    <a href='member.php?id_delete=" . $nim . "' class='btn btn-danger' '>Hapus</a>
                </td>
            </tr>";
}

$member->close();
$tpl = new Template("templates/member.html");
$tpl->replace("DATA_TABEL", $data);

if (isset($_GET['id_edit'])) {
    $tpl->replace("DATA_NIM", "value='" . $update_nim . "' readonly");
    $tpl->replace("DATA_NAMA", "value='" . $update_name . "'");
    $tpl->replace("DATA_JURUSAN", "value='" . $update_jur . "'");
} else {
    $tpl->replace("DATA_NIM", "");
    $tpl->replace("DATA_NAMA", "");
    $tpl->replace("DATA_JURUSAN", "");
}

$tpl->write();
