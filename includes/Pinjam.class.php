<?php

class Pinjam extends DB
{
    function getPinjam()
    {
        $query = "SELECT * FROM pinjam";
        return $this->execute($query);
    }

    function add($data)
    {
        $member = $data['t_member'];
        $buku = $data['t_buku'];
        $status = "Belum";
        $query = "INSERT INTO pinjam values ('', '$member', '$buku', '$status')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM pinjam WHERE id_pinjam = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function statusPinjam($id)
    {
        $status = "Sudah";
        $query = "UPDATE pinjam SET status_kembali = '$status' where id_pinjam = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
