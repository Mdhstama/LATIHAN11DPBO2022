<?php

class Member extends DB
{
    function __construct($db_host = '', $db_user = '', $db_password = '', $db_name = '')
    {
        $this->DB($db_host, $db_user, $db_password, $db_name);
    }

    function getMember()
    {
        $query = "SELECT * FROM member ORDER BY nim";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function getDetail($id)
    {
        $query = "SELECT * FROM member WHERE nim = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function add()
    {
        //mengambil data dari html
        $nim = $_POST['nim'];
        $nama = $_POST['name'];
        $jurusan = $_POST['jurusan'];

        $query = "INSERT INTO member VALUES ('$nim', '$nama', '$jurusan')";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function update($id)
    {
        //mengambil data dari html
        $nama = $_POST['name'];
        $jurusan = $_POST['jurusan'];

        $query = "UPDATE member SET nama = '$nama', jurusan = '$jurusan' WHERE nim = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM member WHERE nim = '$id'";

        // Mengeksekusi query
        return $this->execute($query);
    }
}
