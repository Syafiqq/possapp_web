<?php
ob_start();
?>
<html>
<head>
    <?php
    if (!isset($_GET['control']))
    {
        echo '<title>Welcome To Daskboard</title>';
    }
    else
    {
        if ($_GET['control'] == 'dashboard')
        {
            echo '<title>Welcome To Daskboard</title>';
        }
        else
        {
            if (isset($_GET['action']))
            {
                echo '<title>' . $_GET['action'] . ' ' . $_GET['control'] . '</title>';
            }
            else
            {
                echo '<title>' . $_GET['control'] . '</title>';
            }
        }
    }
    ?>
    <!-- <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" media="screen" href="css/base.css"/>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/bootstrap.js" type="text/javascript"></script>
    <script src="js/jquery.metisMenu.js" type="text/javascript"></script>
    <script src="js/jquery.custom.js" type="text/javascript"></script>
    <script src="js/jquery.qrcode.js" type="text/javascript"></script>
    <script src="js/jquery.form.min.js" type="text/javascript"></script>
    <script src="js/tinymce/tinymce.min.js" type="text/javascript"></script>
    <script src="js/jquery.table2excel.js" type="text/javascript"></script>

    <head>
<body>
<span style="font-family: Raleway; font-weight: bold; display: none;" class="hide"></span>
<?php
require_once("application/view/sidebar.php");
?>
<div class="content">
    <header>
        <div id="title-page">
            <h2 id="judulnya">
                <?php
                if (!isset($_GET['control']))
                {
                    echo "Dashboard";
                }
                else
                {
                    if (isset($_GET['action']))
                    {
                        if ($_GET['action'] == "search")
                        {
                            if (isset($_GET['key']))
                            {
                                echo 'Hasil Pencarian dari no transaksi : ' . $_GET['key'];
                            }
                            elseif (isset($_REQUEST['nama']))
                            {
                                $bln = $_REQUEST['bulan'];
                                $nama = $_REQUEST['nama'];
                                $bulan = "";
                                if ($bln == 1)
                                {
                                    $bulan = 'Januari';
                                }
                                elseif ($bln == 2)
                                {
                                    $bulan = 'Februari';
                                }
                                elseif ($bln == 3)
                                {
                                    $bulan = 'Maret';
                                }
                                elseif ($bln == 4)
                                {
                                    $bulan = 'April';
                                }
                                elseif ($bln == 5)
                                {
                                    $bulan = 'Mei';
                                }
                                elseif ($bln == 6)
                                {
                                    $bulan = 'Juni';
                                }
                                elseif ($bln == 7)
                                {
                                    $bulan = 'Juli';
                                }
                                elseif ($bln == 8)
                                {
                                    $bulan = 'Agustus';
                                }
                                elseif ($bln == 9)
                                {
                                    $bulan = 'September';
                                }
                                elseif ($bln == 10)
                                {
                                    $bulan = 'Oktober';
                                }
                                elseif ($bln == 11)
                                {
                                    $bulan = 'November';
                                }
                                elseif ($bln == 12)
                                {
                                    $bulan = 'Desember';
                                }
                                else
                                {
                                    $bulan = '';
                                }
                                $thn = $_REQUEST['tahun'];
                                if ($nama == "")
                                {
                                    echo 'Hasil Pencarian dari : ' . $bulan . " " . $thn;
                                }
                                else
                                {
                                    echo 'Hasil Pencarian dari : ' . $nama . " - " . $bulan . " " . $thn;
                                }
                            }
                            else
                            {
                                $bln = $_REQUEST['bulan'];
                                $bulan = "";
                                if ($bln == 1)
                                {
                                    $bulan = 'Januari';
                                }
                                elseif ($bln == 2)
                                {
                                    $bulan = 'Februari';
                                }
                                elseif ($bln == 3)
                                {
                                    $bulan = 'Maret';
                                }
                                elseif ($bln == 4)
                                {
                                    $bulan = 'April';
                                }
                                elseif ($bln == 5)
                                {
                                    $bulan = 'Mei';
                                }
                                elseif ($bln == 6)
                                {
                                    $bulan = 'Juni';
                                }
                                elseif ($bln == 7)
                                {
                                    $bulan = 'Juli';
                                }
                                elseif ($bln == 8)
                                {
                                    $bulan = 'Agustus';
                                }
                                elseif ($bln == 9)
                                {
                                    $bulan = 'September';
                                }
                                elseif ($bln == 10)
                                {
                                    $bulan = 'Oktober';
                                }
                                elseif ($bln == 11)
                                {
                                    $bulan = 'November';
                                }
                                elseif ($bln == 12)
                                {
                                    $bulan = 'Desember';
                                }
                                else
                                {
                                    $bulan = '';
                                }
                                $thn = $_REQUEST['tahun'];
                                echo 'Hasil Pencarian dari : ' . $bulan . " " . $thn;
                            }
                        }
                        else
                        {
                            echo $_GET['action'] . ' ' . $_GET['control'];
                        }
                    }
                    else if ($_GET['control'] == "tukar")
                    {
                        echo "Tukar Shift";
                    }
                    elseif ($_GET['control'] == "rekapabsen")
                    {
                        echo "Rekap Absen - " . date('M Y');
                    }
                    elseif ($_GET['control'] == "rekappiket")
                    {
                        echo "Rekap Piket - " . date('M Y');
                    }
                    else
                    {
                        echo $_GET['control'];
                    }
                }

                ?>
            </h2>
        </div>
        <div id="account">
					<span id="hello">
						Selamat Datang, <b><?php echo $_SESSION['username']; ?></b>
					</span>
            <a href="?control=logout">
                <i class="fa log-out"></i>
                <span>Keluar</span>
            </a>
        </div>
        <div class="clear"></div>
    </header>
    <div id="main-content">