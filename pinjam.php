<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Buku.class.php");
include("includes/Author.class.php");
include("includes/Pinjam.class.php");
include("includes/Member.class.php");

$buku = new Buku($db_host, $db_user, $db_pass, $db_name);
$member = new Member($db_host, $db_user, $db_pass, $db_name);
$pinjam = new Pinjam($db_host, $db_user, $db_pass, $db_name);

$buku->open();
$member->open();
$pinjam->open();

$buku->getBuku();
$member->getMember();
$pinjam->getPinjam();

if (isset($_POST['add'])) {
    $pinjam->add($_POST);
    header("location:pinjam.php");
}

if (!empty($_GET['id_hapus'])) {
    $pinjam->delete($_GET['id_hapus']);
    header("location:pinjam.php");
}

if (!empty($_GET['id_edit'])) {
    $pinjam->statusPinjam($_GET['id_edit']);
    header("location:pinjam.php");
}

$data = null;
$dataMember = null;
$dataBuku = null;
$no = 1;

while (list($nim, $nama, $jurusan) = $member->getResult()) {
    $dataMember .= "<option value='" . $nim . "'";
    $dataMember .= ">" . $nama . "</option>";
}

while (list($id_buku, $judul_buku, $penerbit, $deskripsi, $status, $id_author) = $buku->getResult()) {
    $dataBuku .= "<option value='" . $id_buku . "'";
    $dataBuku .= ">" . $judul_buku . "</option>";
}

while (list($id, $member_p, $buku_p, $status) = $pinjam->getResult()) {
    $buku->getDetail($buku_p);
    $member->getDetail($member_p);

    $judul_buku = $buku->getResult();
    $nama_member = $member->getResult();

    if ($status == "Sudah") {
        $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $nama_member['nama'] . "</td>
            <td>" . $judul_buku['judul_buku'] . "</td>
            <td>" . $status . "</td>
            <td>
            <a href='pinjam.php?id_hapus=" . $id . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
    } else {
        $data .= "<tr>
            <td>" . $no++ . "</td>
            <td>" . $nama_member['nama'] . "</td>
            <td>" . $judul_buku['judul_buku'] . "</td>
            <td>" . $status . "</td>
            <td>
            <a href='pinjam.php?id_edit=" . $id .  "' class='btn btn-warning' '>Edit</a>
            <a href='pinjam.php?id_hapus=" . $id . "' class='btn btn-danger' '>Hapus</a>
            </td>
            </tr>";
    }
}

$buku->close();
$member->close();
$pinjam->close();

$tpl = new Template("templates/pinjam.html");
$tpl->replace("DATA_TABEL", $data);
$tpl->replace("DATA_MEMBER", $dataMember);
$tpl->replace("DATA_BUKU", $dataBuku);

$tpl->write();
