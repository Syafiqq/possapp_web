<?php
    $model_transaksi = new model_transaksi; 
	$data = $model_transaksi->search('tb_transaksi',$_GET['key']);
	$detail = $model_transaksi->search_detail('tb_view',$_GET['key']);
	$i=1;
?>
<div id="area-nota">
	<div id="nota">
		<div id="header-nota">
			<h1>Nota Pembelian</h1>
			<span style="text-align:right;display: block;">Nama Pembeli :<?= $data['pembeli'] ?></span>
			<span style="float:left"><strong>No Nota :<?= $data['id'] ?></strong></span>
			<span style="float:right;">Tanggal Transaksi: <?= date('d M Y') ?></span>
			<div class="clear"></div>
		</div>
		<div class="list-barang">
			<table id="table-area" class="tb_nota">
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th style="text-align:right">Harga @ Barang</th>
						<th style="text-align:center">Qty</th>
						<th style="text-align:right">Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						foreach ($detail as $value) {
							echo "
								<tr>
									<td>$i</td>
									<td>".$value['nama_barang']."</td>
									<td style='text-align:right'>".$value['harga']."</td>
									<td style='text-align:center'>".$value['terjual']."</td>
									<td style='text-align:right'>".$value['total']."</td>
								</tr>
								";
							$i++;
						} 
					?>
				</tbody>
			</table>
		</div>
		<div id="footer-nota">
			<span style="display:block;text-align:right;margin-top:20px; "><strong>Total Yang Harus Dibayar : <?= $data['total_harga'] ?></strong></span>
		</div>
	</div>
	<div class="event">
		<a href="http://localhost/barcodescanner/?control=transaksi&action=print_nota&id=<?= $data['id'] ?>" target="_blank">Cetak</a>
		<a href="http://localhost/barcodescanner/?control=transaksi">Kembali</a>
	</div>
</div>
