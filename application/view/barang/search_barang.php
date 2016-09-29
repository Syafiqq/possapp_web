<?php
	 $model_pengumuman = new model_pengumuman; 
    if (isset($_POST['tambah'])) {
        $model_pengumuman->insert_pengumuman();
    }
    elseif (isset($_POST['edit'])) {
    	$model_pengumuman->update_pengumuman();
    }
    //msg.benar="hahahah";
    $status = $_SESSION['status'];
    require_once('form_pengumuman.php');
	if(isset($_GET['key'])) {
?>
	<input type='hidden' id='current_page' />
	<input type='hidden' id='show_per_page' />
	<div id="sub-content">
<?php
	if ($status != "Karyawan"){
?>
	<a href="javascript:void(0)" class="md-trigger" data-modal="modal-3" id="tambah">
		<i class="fa plusAdd"></i>
		<span>Add Data</span>
	</a>
<?php
	}
?>
		<a href="javascript:history.go(-1)" id="kembali">
			<i class="fa fa-mail-reply"></i>
			<span>Back</span>
		</a>
		<form id="search" action="<?php $_SERVER['PHP_SELF']; ?>" method='get'>
			<input type="hidden" name="control" value="pengumuman">
			<input type="hidden" name="action" value="search">
			<i class="fa search"></i>
			<input type='text' name='key' placeholder="Cari pengumuman">
			<input type='submit' id="cari" style="display:none;">
		</form>
		<div class="clear"></div>
	</div>
	<div id="table" class="search-table">
		<table id="table_area">
		<thead>
			<tr id="umumkap">
				<th width=5% class="tablehead">No</th>
				<th class="tablehead" width="20%">Tanggal Akhir</th>
				<th class="tablehead">Judul</th>
				<?php
					if ($status == "Karyawan"){
						$col = 1;
					}else{
						$col = 3;
					}
				?>
				<th class="tablehead" width="20%" colspan="<?php echo $col;?>">Action</th>
			</tr>
		</thead>
		<tbody id="isi_table">
			<?php
				$data = $model_pengumuman->search('tb_pengumuman',$_GET['key']);
				if ($data == null){
					echo '<tr>
								<td colspan="6"><i>Data tidak tersedia.</i></td>
							</tr>';
				}else{
				$i = 1;
				foreach ($data as $value) {
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td id="Tanggal"><?php echo $value['TglAkhir']; ?></td>
						<td id="Judul"><?php echo $value['Judul']; ?></td>
						<td id="Isi" hidden><?php echo $value['Isi']; ?></td>
						<td id="Penulis" hidden><?php echo $value['Penulis']; ?></td>
						<?php
							if ($status != "Karyawan"){
						?>
						<td>
							<a id="<?php echo $value['Id']; ?>"href="javascript:void(0)" class="edit-pengumuman" data-modal="modal-3">
								<i class="fa edit"></i>
								<span>Edit</span>
							</a>
						</td>
						<td>
							<a id="delete" onclick="return confirm('Apakah anda yakin menghapus pengumuman <?php echo $value['Judul']; ?> ?')" href="?control=pengumuman&action=delete&id=<?php echo $value['Id']; ?>">
								<i class="fa delete"></i>
								<span>Delete</span>
							</a>
						</td>
						<?php
							}
						?>
						<td>
							<a id="<?php echo $value['Id']; ?>"href="javascript:void(0)" class="show-pengumuman" data-modal="modal-3">
								<i class="fa fa-newspaper-o"></i>
								<span>Show</span>
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
<?php
	}
?>