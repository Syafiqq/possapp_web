<?php

class model_barang extends model
{

    public static function insert_barang()
    {
        $data = array();
        $data['id_barcode'] = $_POST['barcodekode'];
        $data['nama_barang'] = $_POST['namabarang'];
        $data['letak_barang'] = $_POST['letakbarang'];
        $data['spesifikasi'] = $_POST['spesifikasi'];
        $data['harga'] = $_POST['hargabarang'];
        $data['stok'] = $_POST['stokbarang'];

        model_barang::insert('tb_barang', $data);
        model_barang::movingPage('barang');
    }

    public static function update_barang()
    {
        $data = array();
        $data['nama_barang'] = $_POST['namabarang'];
        $data['letak_barang'] = $_POST['letakbarang'];
        $data['spesifikasi'] = $_POST['spesifikasi'];
        $data['harga'] = $_POST['hargabarang'];
        $data['stok'] = $_POST['stokbarang'];

        model_barang::update('tb_barang', $data, 'id_barcode ="' . trim($_POST['barcodekode']) . '"');
        model_barang::movingPage('barang');
    }

    public static function update_stok()
    {
        $data = array();
        $hasil = $_POST['stokbarang'] + $_POST['tambahstok'];
        $data['stok'] = $hasil;

        model_barang::update('tb_barang', $data, 'id_barcode ="' . trim($_POST['barcodekode']) . '"');
        model_barang::movingPage('barang');
    }

    public static function delete_barang()
    {
        $id = $_GET['id'];

        model_barang::delete('tb_barang', 'id_barcode ="' . $id . '"');
        model_barang::movingPage('barang');
    }
}

?>