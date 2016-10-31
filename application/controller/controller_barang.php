<?php
$logger = Logger::getInstance();
include_once $_SERVER['DOCUMENT_ROOT'] . '/application/model/model_barang.php';
//require_once('application/model/model_barang.php');
$model_barang = new model_barang;

if (isset($_GET['control']))
{
    if (($_GET['control'] == 'barang') AND isset($_GET['action']))
    {
        $logger->addDebug("IF");
        switch ($_GET['action'])
        {
            case 'delete':
                $check = $model_barang->cekSession();
                if ($check == true)
                {
                    $model_barang->delete_barang();
                }
                else
                {
                    $model_barang->viewCekSession();
                }
                break;

            case 'edit':
                $check = $model_barang->cekSession();
                if ($check == true)
                {
                    $model_barang->edit_barang();
                }
                else
                {
                    $model_barang->viewCekSession();
                }
                break;

            case 'search':
                $model_barang->sessionPage("application/view/barang/search_barang.php");
                break;

            default:
                $model->sessionPage("application/view/not-found.php");
                break;
        }
    }
    elseif (($_GET['control'] == 'barang') AND !isset($_GET['action']))
    {
        $logger->addDebug("ELSIF");
        //$model_barang->sessionPage("application/view/barang/table_barang.php");
        $model_barang->sessionPage($_SERVER['DOCUMENT_ROOT'] . 'application/view/barang/table_barang.php');
    }
}
else
{
    $model->sessionPage("application/view/not-found.php");
}
?>