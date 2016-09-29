<?php
	require_once ('../../model/model.php');
	include "../../../config.php";
	$model = new model;

	$data = $model->getAllDataWhere('tb_barang', 'id_barcode = "'.$_POST['barcode'].'"');
	if ($data != null){
		foreach ($data as $value) {
			if($value['stok']>0 && $value['stok']>= $_POST['tot']) {
				echo $value['id_barcode'].";".$value['nama_barang'].";".$value['harga'].";".$value['stok'].";";
			}else {
				echo 1;
			}
		}
	}else{
		echo 0;
	}
?>