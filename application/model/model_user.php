<?php

class model_user extends model
{
    public function insert_user()
    {
        $data = array();
        $pengacak = '2812AaRrYuHgBnMk';
        $data['NIK'] = $_POST['NIK'];
        $data['Level'] = $_POST['status'];

        $total = model_user::totalDataWhere("tb_admin", "NIK = '" . $data['NIK'] . "'");
        if ($total > 1 OR $total == 1)
        {
            ?>
            <script type="text/javascript">
                alert("NIK ini sudah memiliki akun!");
            </script>
            <?php
        }
        else
        {
            $ceknik = model_user::getAllDataWhere("tb_karyawan", 'NIK = "' . $data['NIK'] . '"');
            foreach ($ceknik as $key)
            {
                $data['Nama'] = $key['Nama'];
            }
            $acakpass = md5($pengacak . md5($pengacak . md5($_POST['password']) . $pengacak) . $pengacak);
            $data['Password'] = $acakpass;
            model_user::insert('tb_admin', $data);
            model_user::movingPage('user');
        }
    }

    public function update_user()
    {
        $NIK = $_POST['NIK'];
        $data = array();
        $pengacak = '2812AaRrYuHgBnMk';
        $ceknik = model_user::getAllDataWhere("tb_karyawan", 'NIK = "' . $NIK . '"');
        foreach ($ceknik as $key)
        {
            $data['Nama'] = $key['Nama'];
        }

        if (isset($_POST['statusubah']))
        {
            $data['Level'] = $_POST['statusubah'];
        }

        if (!empty($_POST['passwordlama']))
        {
            $acakpass = md5($pengacak . md5($pengacak . md5($_POST['passwordlama']) . $pengacak) . $pengacak);
            $cek = model_user::getAllDataWhere("tb_admin", 'NIK = "' . $NIK . '" AND Password = "' . $acakpass . '"');
            if ($cek == null)
            {
                ?>
                <script type="text/javascript">
                    alert("Password tidak cocok!");
                </script>
                <?php
            }
            else
            {
                $acakpassbaru = md5($pengacak . md5($pengacak . md5($_POST['passwordbaru']) . $pengacak) . $pengacak);
                $data['Password'] = $acakpassbaru;
                // echo $data['Password'];
            }
        }
        model_user::update('tb_admin', $data, 'NIK = "' . $NIK . '"');
        model_user::movingPage('user');
    }

    public function delete_user()
    {
        $id = $_GET['id'];
        if (isset($id))
        {
            model_user::delete('tb_admin', 'NIK ="' . $id . '"');
            model_user::movingPage('user');
        }
        else
        {
            echo "Error";
        }
    }
}

?>