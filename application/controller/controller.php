<?php
require_once('application/model/model.php');

$model = new model;
if (isset($_GET['control']))
{

    switch ($_GET['control'])
    {

        case 'dashboard':
            $model->sessionPage("application/view/header.php");
            $model->sessionPage("application/view/daskboard.php");
            $model->sessionPage("application/view/footer.php");
            break;

        case 'barang':
            $model->sessionPage("application/view/header.php");
            require_once $_SERVER['DOCUMENT_ROOT'] . '/application/controller/controller_barang.php';
            //require_once('application/controller/controller_barang.php');
            $model->sessionPage("application/view/footer.php");
            break;
        case 'transaksi':
            // $model->sessionPage("application/view/header.php");
            require_once('application/controller/controller_transaksi.php');
            // $model->sessionPage("application/view/footer.php");
            break;

        case 'login':
            require_once('application/view/login.php');
            break;
        case 'logout':
            $model->logout();
            require_once('application/view/login.php');
            break;
        default:
            $model->sessionPage("application/view/not-found.php");
            break;
    }
}
else
{
    $logger = Logger::getInstance();
    $logger->addDebug($_SERVER['PATH_INFO']);
    switch ($_SERVER['PATH_INFO'])
    {
        case '/ws/goods/get' :
        {
            $logger->addDebug("post " . var_export($_POST, true));
            $sql = "SELECT `id_barcode`, `nama_barang`, `letak_barang`, `spesifikasi`, `harga`, `stok` FROM `tb_barang` WHERE `id_barcode` = '{$_POST['barcode']}' LIMIT 1";
            $result = $connect->query($sql);
            if ($result->num_rows > 0)
            {
                echo json_encode(array('status' => 1, 'data' => $result->fetch_assoc()));
            }
            else
            {
                echo json_encode(array('status' => 0));
            }
            return;
        }
        case '/ws/goods/checkout' :
        {
            $logger->addDebug("post " . var_export($_POST, true));
            $inRand = mt_rand(1, 10);
            $sql = "INSERT INTO tb_transaksi (id, no_urut, tgl_transaksi, pembeli, total_barang, total_harga)VALUES (NULL, {$inRand}, CURRENT_TIMESTAMP, '{$_POST['name']}', {$_POST['total']}, 0)";

            if ($connect->query($sql) === TRUE)
            {
                $last_id = $connect->insert_id;
                if ($_POST['total'] > 0)
                {
                    $sql = "INSERT INTO tb_transaksi_barang (transaksi_id, barcode_barang, total) VALUES ";
                    $counter = -1;
                    for ($i = -1, $is = $_POST['total']; ++$i < $is;)
                    {
                        $sql .= "({$last_id}, {$_POST['barang'.$i]}, 1)";
                        if (($i + 1) != $is)
                        {
                            $sql .= ",";
                        }
                    }
                    if ($connect->query($sql) === TRUE)
                    {
                        $sql = "SELECT COALESCE(SUM(`tb_transaksi_barang`.`total` * `tb_barang`.`harga`), 0) AS 'total' FROM `tb_transaksi_barang` LEFT JOIN `tb_transaksi` ON `tb_transaksi_barang`.`transaksi_id` = `tb_transaksi`.`id` LEFT JOIN tb_barang ON `tb_transaksi_barang`.`barcode_barang` = `tb_barang`.`id_barcode` WHERE `tb_transaksi`.`id` = {$last_id}";
                        $result = $connect->query($sql);
                        if ($result->num_rows > 0)
                        {
                            $total = $result->fetch_assoc()['total'];
                            $sql = "UPDATE `tb_transaksi` SET `total_harga` = {$total} WHERE `id` = ${last_id}";
                            $connect->query($sql);
                            echo json_encode(array('status' => 1, 'total' => $total));
                            return;
                        }
                    }
                }
            }
            echo json_encode(array('status' => 0));
            return;
        }
    }
    $cek = $model->cekSession();
    if ($cek == true)
    {
        require_once('application/view/header.php');
        require_once('application/view/daskboard.php');
        require_once('application/view/footer.php');
    }
    elseif ($cek == false)
    {
        require_once('application/view/login.php');
    }

    // require_once('application/controller/controller_user.php');
}
?>