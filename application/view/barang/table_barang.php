<?php
    $model_barang = new model_barang; 
    if (isset($_POST['tambah'])) {
        $model_barang->insert_barang();
    }
    if (isset($_POST['edit'])) {
    	$model_barang->update_barang();
    }
    if (isset($_POST['stok'])) {
    	$model_barang->update_stok();
    }
    //msg.benar="hahahah"
    require_once('form_barang.php');
?>
<!-- the input fields that will hold the variables we will use -->
<input type='hidden' id='current_page' />
<input type='hidden' id='show_per_page' />
<div id="sub-content">
	<a href="javascript:void(0)" class="md-trigger" data-modal="modal-3" id="tambah">
		<i class="fa plusAdd"></i>
		<span>Tambah Barang</span>
	</a>
	<a href="javascript:void(0)" class="md-trigger" data-modal="modal-3" id="stok">
		<i class="fa fa-edit"></i>
		<span>Tambah Stok</span>
	</a>
	<!-- <form id="search" action="<?php //$_SERVER['PHP_SELF']; ?>" method='get'>
		<input type="hidden" name="control" value="barang">
		<input type="hidden" name="action" value="search">
		<i class="fa search"></i>
		<input type='text' name='key' placeholder="Cari barang">
		<input type='submit' id="cari" style="display:none;">
	</form> -->
	<div class="clear"></div>
</div>
<div id="table">
	<table id="table_area">
		<thead>
			<tr id="umumkap">
				<th width=5% class="tablehead">No</th>
				<th class="tablehead" width="20%">Nama Barang</th>
				<th class="tablehead">Letak Barang</th>
				<th class="tablehead">Harga</th>
				<th class="tablehead">Stok</th>
				<th class="tablehead" width="20%" colspan="3">Action</th>
			</tr>
		</thead>
		<tbody id="isi_table">
			<?php
				$data = $model_barang->getAllData('tb_barang');
				$i = 1;
				if ($data == null){
					echo '<tr>
								<td colspan="6"><i>Data tidak tersedia.</i></td>
							</tr>';
				}else{
					foreach ($data as $value) {
						?>
						<tr>
							<td id="barcode" hidden><?php echo $value['id_barcode']; ?>
							<td width=5%><?php echo $i; ?></td>
							<td id="nama"><?php echo $value['nama_barang']; ?></td>
							<td id="letak"><?php echo $value['letak_barang']; ?></td>
							<td id="spesifikasi" hidden><?php echo $value['spesifikasi']; ?></td>
							<td id="harga"><?php echo $value['harga']; ?></td>
							<td id="stok"><?php echo $value['stok']; ?></td>
							<td>
								<a id="<?php echo $value['id_barcode']; ?>" href="javascript:void(0)" class="edit-barang" data-modal="modal-3">
									<i class="fa edit"></i>
									<span>Edit</span>
								</a>
							</td>
							<td>
								<a id="delete" onclick="return confirm('Apakah anda yakin menghapus barang <?php echo $value['nama_barang']; ?> ?')" href="?control=barang&action=delete&id=<?php echo $value['id_barcode']; ?>">
									<i class="fa delete"></i>
									<span>Delete</span>
								</a>
							</td>
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