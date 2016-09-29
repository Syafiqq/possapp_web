<?php
	require_once ('../../model/model.php');
	include "../../../config.php";
	$model = new model;
	if ($_POST['status'] == "tambah"){
		$data = $model->getAllDataWhere('tb_barang', 'id_barcode = "'.$_POST['barcode'].'"');
		if ($data != null){
			foreach ($data as $value) {
				echo $value['id_barcode'];
			}
		}else{
			echo "tidak ada";
		}
	}
	if ($_POST['status'] == "check"){
		$data = $model->getAllDataWhere('tb_barang', 'id_barcode = "'.$_POST['barcode'].'"');
		if ($data != null){
			foreach ($data as $value) {
				echo $value['id_barcode'].";".$value['nama_barang'].";".$value['letak_barang'].";".$value['spesifikasi'].";".$value['harga'].";".$value['stok'].";";
			}
		}else{
			echo "tidak ada";
		}
	} 
?>