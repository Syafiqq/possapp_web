<?php
    $model_transaksi = new model_transaksi; 
	    if (isset($_POST['tambah'])) {
	        $model_transaksi->insert_transaksi();
	        $max = $model_transaksi->getMaxDataWhere("id","tb_transaksi","tgl_transaksi='".date('Y-m-d')."'");
	        $no = $_POST['no_urut'];
	        $id = $max[0];
	        $url = 'http://'.$_SERVER['HTTP_HOST'].str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME'])."?control=transaksi&action=print&no=$no&id=$id";
	        echo '<script type="text/javascript">
	        	window.open("'.$url.'","_blank");
	        	</script>';
	    }
    //msg.benar="hahahah"
    require_once('form_transaksi.php');
    $ids = model_transaksi::getMaxData("id","tb_transaksi");
	echo $ids[0];
?>
<!-- the input fields that will hold the variables we will use -->
<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />
<div id="sub-content">
	<a href="javascript:void(0)" class="md-trigger" data-modal="modal-3" id="tambahtransaksi">
		<i class="fa plusAdd"></i>
		<span>Tambah transaksi</span>
	</a>
	<!-- <form id="search" action="<?php //$_SERVER['PHP_SELF']; ?>" method='get'>
		<input type="hidden" name="control" value="transaksi">
		<input type="hidden" name="action" value="search">
		<i class="fa search"></i>
		<input type='text' name='key' placeholder="Cari transaksi">
		<input type='submit' id="cari" style="display:none;">
	</form> -->
	<div class="clear"></div>
</div>
<div id="table">
	<table id="table_area">
		<thead>
			<tr id="umumkap">
				<th width=5% class="tablehead">No</th>
				<th class="tablehead" width="20%">Nama Pembeli</th>
				<th class="tablehead">Tanggal transaksi</th>
				<th class="tablehead">Total Barang</th>
				<th class="tablehead">Total Harga</th>
			</tr>
		</thead>
		<tbody id="isi_table">
			<?php
				$data = $model_transaksi->getAllData('tb_transaksi');
				$i = 1;
				if ($data == null){
					echo '<tr>
								<td colspan="6"><i>Data tidak tersedia.</i></td>
							</tr>';
				}else{
					foreach ($data as $value) {
						?>
						<tr>
							<td id="barcode" hidden><?php echo $value['id']; ?>
							<td width=5%><?php echo $i; ?></td>
							<td id="pembeli"><?php echo $value['pembeli']; ?></td>
							<td id="tgl"><?php echo $value['tgl_transaksi']; ?></td>
							<td id="totalbrg"><?php echo $value['total_barang']; ?></td>
							<td id="totalharga"><?php echo $value['total_harga']; ?></td>
						</tr>
						<?php
						$i++;
					}
				}
			?>
		</tbody>
	</table>
</div>
<!-- An empty div which will be populated using jQuery -->
<div id='page_navigation'><div class="clear"></div></div>