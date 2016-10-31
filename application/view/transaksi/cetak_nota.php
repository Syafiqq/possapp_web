<script type="text/javascript">
    window.print();
</script>
<style type="text/css">
    html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, font, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td {
        margin: 0;
        padding: 0;
        border: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
    }

    body {
        line-height: 1;
    }

    ol, ul {
        list-style: none;
    }

    blockquote, q {
        quotes: none;
    }

    blockquote:before, blockquote:after, q:before, q:after {
        content: '';
        content: none;
    }

    :focus {
        outline: 0;
    }

    ins {
        text-decoration: none;
    }

    del {
        text-decoration: line-through;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    #header-nota h1 {
        font-size: 24px;
        text-align: center;
    }

    #header-nota span {
        line-height: 1.3em;
        padding-top: 15px;
    }

    #area-nota {
        margin: 20px;
    }

    #nota {
        display: block;
        width: 500px;
        display: inline-block;
        padding: 20px;
        border: 1px solid #111111;

    }

    .tb_nota {
        width: 100%;
    }

    .tb_nota thead {
        border-bottom: 2px solid #111111;
    }

    .tb_nota thead tr,
    .tb_nota tbody tr {
        height: 30px;
    }

    .tb_nota thead tr th {
        padding: 15px 0;
    }

    .tb_nota tbody tr td {
        padding: 10px 0;
        border-bottom: 1px solid #111111;
    }

    .list-barang {
        margin-top: 20px;
        width: 100%;
    }

    #list-barang .tb_nota,
    #list-barang .tb_nota thead {
        display: block;
        width: 100%
    }
</style>
<?php
$model_transaksi = new model_transaksi;
$data = $model_transaksi->search('tb_transaksi', $_GET['id']);
$detail = $model_transaksi->search_detail('tb_view', $_GET['id']);
$i = 1;
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
                foreach ($detail as $value)
                {
                    echo "
								<tr>
									<td>$i</td>
									<td>" . $value['nama_barang'] . "</td>
									<td style='text-align:right'>" . $value['harga'] . "</td>
									<td style='text-align:center'>" . $value['terjual'] . "</td>
									<td style='text-align:right'>" . $value['total'] . "</td>
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
</div>
