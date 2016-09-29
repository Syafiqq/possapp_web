<?php
		$open = '<div class="one-third">';
		$close = '</div>';
		$barang = '<a href="?control=barang" class="box"><div id="barang">
		<div id="icon"><i class="fa fa-table"></i></div>
		<div id="content">
			<h2>Tabel Barang</h2>
		</div>
	</div></a>';
		$tmbhBarang = '<a href="?control=barang" class="box"><div id="tambahBarang">
		<div id="icon"><i class="fa fa-plus-square"></i></div>
		<div id="content">
			<h2>Tambah Barang</h2>
		</div>
	</div></a>';
	$transaksi = '<a href="?control=transaksi" class="box"><div id="transksi">
		<div id="icon"><i class="fa fa-shopping-cart"></i></div>
		<div id="content">
			<h2>'.($_SESSION['username']=="input" ? "Tambah Transaksi" : "Cek Transaksi").'</h2>
		</div>
	</div></a>';
	// 	$tmbhStok = '<a href="?control=stock" class="box"><div id="stock">
	// 	<div id="icon"><i class="fa fa-cart-arrow-down"></i></div>
	// 	<div id="content">
	// 		<h2>Tambah Stok Barang</h2>
	// 	</div>
	// </div></a>';
	if ($_SESSION['username']=="admin") {
		echo $open;
	    echo $barang;
	    echo $tmbhBarang;
	    // echo $tmbhStok;
	    // echo $transaksi;
	    echo $close;
	}elseif($_SESSION['username']=="kasir") {
		echo $open;
    	echo $transaksi;
    	echo $close;
	}else {
    	echo $open;
    	echo $transaksi;
    	echo $close;
		
	}
    // echo $barang;
    // echo $tmbhBarang;
    // echo $tmbhStok;
    // echo $transaksi;
    // echo $close;
    // echo $open;
    // echo $close;
	?>