<script type="text/javascript">
	$(function(){
		$("#key").focus();
	})
</script>
<form id="search" action="<?php $_SERVER['PHP_SELF']; ?>" method='get'>
	<input type="hidden" name="control" value="transaksi">
	<input type="hidden" name="action" value="search">
	<i class="fa search"></i>
	<span>Masukan No Transaksi Pembelian : </span>
	<input type='text' name='key' id="key" placeholder="No Transaksi">
	<input type='submit' id="cari" value="Cari Transaksi">
</form>