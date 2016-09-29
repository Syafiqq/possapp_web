<button id="play" data-toggle="tooltip" title="Play" type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-play"></span></button>
<div class="error"></div>
<div class="md-modal md-effect-3" id="modal-3">
    <div class="md-content">
        <h3 id="keta"></h3>
        <i class="fa fa-close md-close"></i>
        <div class="content-modal">
          <div id="form">
            <form id="form-area" action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                <div class="form barang">
                    <div class="duapertiga" style="margin-right:2.3%">
                        <input class="text full-width" type="text" name="status" id="status" maxlength="44" hidden>
                        <div class="setengah" style="margin-right: 2.5%; margin-top: 15px;">
                            <label>Barcode Kode :</label>
                            <input class="text full-width" type="text" name="barcodekode" id="barcodekode" maxlength="40" autofocus>
                        </div>
                        <div class="setengah" style="margin-top: 15px;">
                            <label>Nama Barang :</label>
                            <input class="text full-width" type="text" name="namabarang" id="namabarang" maxlength="40" required>
                        </div>
                        <div id="letakarea">
                            <label>Letak Barang :</label>
                            <input class="text full-width" type="text" name="letakbarang" id="letakbarang" maxlength="80" required>
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
                    <div id="spesifikasiarea">
                            <label>Spesifikasi Barang :</label>
                            <div class="spesifikasi">
                                <textarea name="spesifikasi" id="spesifikasi" placeholder="Spesifikasi"></textarea>
                            </div>
                        </div>
                    <div class="setengah" style="margin-right: 2.5%; margin-top: 15px;" id="hargaarea">
                            <label>Harga Barang :</label>
                            <input class="text full-width" type="text" name="hargabarang" id="hargabarang" maxlength="13" required>
                        </div>
                        <div class="setengah" style="margin-top: 15px;">
                            <div class="setengah" style="margin-right: 2.5%;" id="stokarea">
                                <label>Stok Barang :</label>
                                <input class="text full-width" type="text" name="stokbarang" id="stokbarang" maxlength="3" required>
                            </div>
                            <div class="setengah" id="tambahstokarea">
                                <label>Tambah Stok</label>
                                <input class="text full-width" type="text" name="tambahstok" id="tambahstok" maxlength="3">
                            </div>
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