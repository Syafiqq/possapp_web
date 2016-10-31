<?php
$dashboard = '';
$barang = '';
$transaksi = '';

if (!isset($_GET['control']))
{
    $dashboard = 'active';
}
else
{
    if ($_GET['control'] == 'dashboard')
    {
        $dashboard = 'active';
    }
    elseif ($_GET['control'] == 'transaksi')
    {
        $transaksi = 'active';
    }
    else
    {
        $barang = 'active';
    }
}
?>
<div class="sidebar">
    <div id="logo">
        <a href="?control=dashboard"><h1>Barcode Scanner</h1></a>
    </div>
    <div id="vertical-menu">
        <ul class="nav" id="main-menu">
            <?php

            $dashboard = "<li class='" . $dashboard . "'>
				<a href='?control=dashboard'>
					<i class='fa home fa-2x'></i>
					<span>Dashboard</span>
				</a>
			</li>";
            $transaksi = '<li class="' . $transaksi . '">
				<a href="?control=transaksi" class="parent-barang">
					<i class="fa fa-shopping-cart"></i>
					<span>Transaksi</span>
				</a>
			</li>';
            $barang = '<li class="' . $barang . '">
				<a href="?control=barang" class="parent-barang">
					<i class="fa fa-table"></i>
					<span>Barang</span>
				</a>
			</li>';
            if ($_SESSION['username'] == "admin")
            {
                echo $dashboard;
                echo $barang;
            }
            elseif ($_SESSION['username'] == "kasir")
            {
                echo $dashboard;
                echo $transaksi;
            }
            else
            {
                echo $dashboard;
                echo $transaksi;

            }
            // echo $dashboard;
            // echo $transaksi;
            // echo $barang;
            ?>
            <div class="clear"></div>
        </ul>
    </div>
</div>