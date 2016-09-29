<?php
	class model_transaksi extends model {
	
		public static function insert_transaksi() {
			$tran = array();
			$detail = array();
			$update = array();
			$ids = model_transaksi::getMaxData("id","tb_transaksi");
			$tran['no_urut'] = $_POST['no_urut'];
			$tran['id'] = $ids[0]+1;
			$tran['tgl_transaksi'] = date('Y-m-d');
			$tran['pembeli'] = $_POST['pembeli'];
			$tran['total_barang'] = $_POST['totalbarang'];
			$tran['total_harga'] = $_POST['totalbayar'];
			$tr = rtrim($_POST['detail'], "-");
			$getDetail = explode('-',$tr);
			// echo count($getDetail);
			foreach ($getDetail as $value) {
				$getIsi = explode(";", $value);
				$detail['id_transaksi'] = $id[0]+1;
				$detail['id_barcode'] = $getIsi[0];
				$detail['terjual'] = $getIsi[1];
				$detail['total'] = $getIsi[2];
				$stokaw = model_transaksi::getDataWhere('tb_barang','id_barcode ="'.$getIsi[0].'"'); 
				$sisa = $stokaw['stok'] - $getIsi[1];
				$update['stok'] = $sisa;
				model_transaksi::insert('tb_detail',$detail);
				model_transaksi::update('tb_barang',$update,'id_barcode ="'.$getIsi[0].'"');
			}
			model_transaksi::insert('tb_transaksi',$tran);
			model_transaksi::movingPage('transaksi');
		}
		public static function select_max($field,$table) {
			$query = model_transaksi::query("SELECT max($field),tgl_transaksi as $field FROM $table");
			return $query;
		}
		public static function select_max_where($field,$table,$where) {
			$query = model_transaksi::query("SELECT max($field),tgl_transaksi as $field FROM $table WHERE $where");
			return $query;
		}
		public function getMaxData($field,$table) {
			$query = model_transaksi::select_max($field,$table);
			$data = mysql_fetch_row($query);
			return $data;
		}
		public function getMaxDataWhere($field,$table,$where) {
			$query = model_transaksi::select_max_where($field,$table,$where);
			$data = mysql_fetch_row($query);
			return $data;
		}
	}

?>



