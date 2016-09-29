<?php
	
	require_once ('../../model/model_transaksi.php');
	include "../../../config.php";
	$model_transaksi = new model_transaksi; 
	$data = array();
	$id=0;
	$check = $model_transaksi->getAllDataCount('id','tb_transaksi');
	if ($check == null){
		$id=1;
	}else {
		$id=$check[0];
	}
	$tran['id'] = $id;
	$check = $model_transaksi->totalDataWhere("tb_transaksi","tgl_transaksi='".date('Y-m-d')."'");
	$max = $model_transaksi->getMaxDataWhere("no_urut","tb_transaksi","tgl_transaksi='".date('Y-m-d')."'");
	$urut = 0;
	if ($check > 0) {
		$urut = $max[0]+1;
	}else {
		$urut = 1;
	}
	$tran['no_urut'] = $urut;
	$tran['tgl_transaksi'] = $_POST['tgl'];
	$tran['pembeli'] = $_POST['pembeli'];
	$tran['total_barang'] = $_POST['totalbarang'];
	$tran['total_harga'] = $_POST['totalbayar'];
	$getDetail = explode('-',$_POST['detail']);
	foreach ($getDetail as $value) {
		$getIsi = explode(";", $value);
		foreach ($get as $key) {
			$data['id_transaksi'] = $id;
			$data['id_barcode'] = $key[0];
			$data['terjual'] = $key[1];
			$data['total'] = $key[2];
			model_transaksi::insert('tb_detail',$data);
		}
	}
	model_transaksi::insert('tb_transaksi',$tran);
?>	