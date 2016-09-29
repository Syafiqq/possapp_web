<button id="play" data-toggle="tooltip" title="Play" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-play"></span></button>
<div class="error"></div>
<div class="md-modal md-effect-3" id="modal-3">
    <?php
        $check = $model_transaksi->totalDataWhere("tb_transaksi","tgl_transaksi='".date('Y-m-d')."'");
        $max = $model_transaksi->getMaxDataWhere("no_urut","tb_transaksi","tgl_transaksi='".date('Y-m-d')."'");
        $urut = 0;
        if ($check > 0) {
            $urut = $max[0]+1;
        }else {
            $urut = 1;
        }
    ?>
    <div class="md-content">
        <h3 id="keta"></h3>
        <i class="fa fa-close md-close"></i>
        <div class="content-modal">
          <div id="form">
            <form id="form-area" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form transaksi">
                    <input class="text full-width" type="hidden" name="detail" id="detail">
                    <input class="text full-width" type="hidden" name="no_urut" id="no_urut" value="<?= $urut ?>">
                    <div class="duapertiga" style="margin-right:2.3%">
                        <input class="text full-width" type="text" name="status" id="status" maxlength="44" hidden>
                        <label>Pembeli :</label>
                        <input class="text full-width" type="text" name="pembeli" id="pembeli" maxlength="40" autofocus>
                        <div class="duapertiga" style="margin-right: 0.5%; margin-top: 15px;">
                            <div class="setengah" style="margin-right: 2%;">
                                <label>Barcode :</label>
                                <input class="text full-width" type="text" name="barcodekode" id="barcodekode" maxlength="44">
                            </div>
                            <div class="setengah">
                                <label>Total Barang :</label>
                                <input class="text full-width" type="text" name="total" id="total" maxlength="3">
                            </div>
                        </div>
                        <div class="sepertiga" style="margin-top: 15px;">
                            <label>   </label>
                            <a href="#" id="submit-barang">Beli</a>
                        </div>
                    </div>
                    <div class="sepertiga">
                        <div id="qr-area">
                            <div id="scanner-laser-area">
                                <canvas id="qr-canvas"></canvas>
                                <div class="scanner-laser laser-leftTop"></div>
                                <div class="scanner-laser laser-rightTop"></div>
                                <div class="scanner-laser laser-leftBottom"></div>
                                <div class="scanner-laser laser-rightBottom"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                    <div id="barangdibeli">
                            <label>Barang dibeli:</label>
                            <table id="table_dibeli">
                                <thead>
                                    <tr>
                                        <th class="tablehead" width="20%">Nama Barang</th>
                                        <th class="tablehead">Total Barang</th>
                                        <th class="tablehead">Harga Satuan</th>
                                        <th class="tablehead">Total Harga</th>
                                        <th class="tablehead">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="isi_table"></tbody>
                            </table>
                    </div>
                    <div class="setengah" style="margin-right: 2.5%; margin-top: 15px;">
                        <label>Total Barang :</label>
                        <input class="text full-width" type="text" name="totalbarang" id="totalbarang" maxlength="13" required>
                    </div>
                    <div class="setengah" style="margin-top: 15px;">
                        <label>Total Bayar :</label>
                        <input class="text full-width" type="text" name="totalbayar" id="totalbayar" maxlength="3" required>
                    </div>
                        <div id="submit"></div>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
<div class="md-overlay"></div>
<script type="text/javascript" src="js/qrcodelib.js"></script>
<script type="text/javascript" src="js/DecoderWorker.js"></script>
<script type="text/javascript" src="js/WebCodeCam.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/custom.js"></script>