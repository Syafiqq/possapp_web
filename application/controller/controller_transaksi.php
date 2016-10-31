<?php
require_once('application/model/model_transaksi.php');
$model_transaksi = new model_transaksi;
if (isset($_GET['control']))
{
    if (($_GET['control'] == 'transaksi') AND isset($_GET['action']))
    {
        switch ($_GET['action'])
        {
            case 'delete':
                $check = $model_transaksi->cekSession();
                if ($check == true)
                {
                    $model_transaksi->delete_transaksi();
                }
                else
                {
                    $model_transaksi->viewCekSession();
                }
                break;
            case 'edit':
                $check = $model_transaksi->cekSession();
                if ($check == true)
                {
                    $model_transaksi->edit_transaksi();
                }
                else
                {
                    $model_transaksi->viewCekSession();
                }
                break;
            case 'print':
                $model_transaksi->sessionPage("application/view/transaksi/print_transaksi.php");
                break;

            case 'print_nota':
                $model_transaksi->sessionPage("application/view/transaksi/cetak_nota.php");
                break;

            case 'search':
                $model->sessionPage("application/view/header.php");
                $model_transaksi->sessionPage("application/view/transaksi/hasil_cari_transaksi.php");
                $model->sessionPage("application/view/footer.php");
                break;

            default:
                $model->sessionPage("application/view/not-found.php");
                break;
        }
    }
    elseif (($_GET['control'] == 'transaksi') AND !isset($_GET['action']))
    {
        $model->sessionPage("application/view/header.php");
        if ($_SESSION['username'] == "input")
        {
            $model_transaksi->sessionPage("application/view/transaksi/table_transaksi.php");
        }
        else if ($_SESSION['username'] == "kasir")
        {
            $model_transaksi->sessionPage("application/view/transaksi/cari_transaksi.php");
        }
        $model->sessionPage("application/view/footer.php");
    }
}
else
{
    $model->sessionPage("application/view/not-found.php");
}
?>