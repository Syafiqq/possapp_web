<?php
	require_once('application/model/model.php');

	$model = new model;
	if(isset($_GET['control'])) {
		
		switch ($_GET['control']) {

			case 'dashboard':
				$model->sessionPage("application/view/header.php");
				$model->sessionPage("application/view/daskboard.php");
				$model->sessionPage("application/view/footer.php");
				break;

			case 'barang':
				$model->sessionPage("application/view/header.php");
				require_once('application/controller/controller_barang.php');
				$model->sessionPage("application/view/footer.php");
				break;
			case 'transaksi':
				// $model->sessionPage("application/view/header.php");
				require_once('application/controller/controller_transaksi.php');
				// $model->sessionPage("application/view/footer.php");
				break;

			case 'login':
				require_once('application/view/login.php');
				break;
			case 'logout':
				$model->logout();
				require_once('application/view/login.php');
				break;
			default:
				$model->sessionPage("application/view/not-found.php");
				break;
		}
	}
	else {
		$cek = $model->cekSession();
		if($cek == true){
			require_once('application/view/header.php');
			require_once('application/view/daskboard.php');
			require_once('application/view/footer.php');
		}elseif($cek == false){
			require_once('application/view/login.php');
		}
		
		// require_once('application/controller/controller_user.php');
	}
?>