<?php

class model
{
    public static function getExtension($str)
    {
        $i = strrpos($str, ".");
        if (!$i)
        {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    public static function compressImage($ext, $uploadedfile, $path, $actual_image_name, $newwidth)
    {
        if ($ext == "jpg" || $ext == "jpeg")
        {
            $src = imagecreatefromjpeg($uploadedfile);
        }
        else if ($ext == "png")
        {
            $src = imagecreatefrompng($uploadedfile);
        }
        else if ($ext == "gif")
        {
            $src = imagecreatefromgif($uploadedfile);
        }
        else
        {
            $src = imagecreatefrombmp($uploadedfile);
        }

        list($width, $height) = getimagesize($uploadedfile);
        // $newheight=($height/$width)*$newwidth;
        if ($newwidth == 3540)
        {
            $newheight = 2658;
        }
        elseif ($newwidth == 374)
        {
            $newheight = 281;
        }
        elseif ($newwidth == 336)
        {
            $newheight = 252;
        }
        elseif ($newwidth == 230)
        {
            $newheight = 230;
        }

        $tmp = imagecreatetruecolor($newwidth, $newheight);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $filename = $actual_image_name . '_' . $newwidth . '.jpg'; //PixelSize_TimeStamp.jpg
        imagejpeg($tmp, $path . "/" . $filename, 100);
        imagedestroy($tmp);
        return $filename;
    }

    public static function getDataOrder($table, $order)
    {
        $query = model::select_order($table, $order);
        $data = mysql_fetch_array($query);
        return $data;
    }

    public static function select_order($table, $order)
    {
        $query = model::query("SELECT * FROM $table $order");
        return $query;
    }

    public static function query($query)
    {
        $query = mysql_query($query) or die(mysql_error());
        return $query;
    }

    public static function getAllDataWhere($table, $where)
    {
        $array = array();
        $query = model::select_where($table, $where);
        // echo $query;
        while ($row = mysql_fetch_array($query))
        {
            $array[] = $row;
        }
        return $array;
    }

    public static function select_where($table, $where)
    {
        $query = model::query("SELECT * FROM $table WHERE $where");
        // echo ("SELECT * FROM $table WHERE $where"."<br/>");
        return $query;
    }

    public static function insert($table, $array = array())
    {
        $fieldDB = " ( ";
        $valueInput = " VALUES( ";

        foreach ($array as $key => $value)
        {
            $fieldDB .= $key . ",";
        }
        $fieldDB = rtrim($fieldDB, ",");
        $fieldDB .= " ) ";

        foreach ($array as $key => $value)
        {
            $valueInput .= "'" . $value . "' ,";
        }
        $valueInput = rtrim($valueInput, ",");
        $valueInput .= " ) ";
        // echo ("INSERT INTO $table $fieldDB $valueInput");
        model::query("INSERT INTO $table $fieldDB $valueInput");
    }

    public static function update($table, $array = array(), $where)
    {
        $setvalue = " SET ";
        foreach ($array as $key => $value)
        {
            $setvalue .= $key . " = '" . $value . "',";
        }
        $setvalue = rtrim($setvalue, ',');
        //echo "UPDATE $table $setvalue WHERE $where";
        model::query("UPDATE $table $setvalue WHERE $where");
    }

    public static function RemoveDirectory($dirPath)
    {
        if (!is_dir($dirPath))
        {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/')
        {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file)
        {
            if (is_dir($file))
            {
                self::RemoveDirectory($file);
            }
            else
            {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    public static function delete($table, $where)
    {
        mysql_query("DELETE FROM $table WHERE $where");
    }

    public static function goBack()
    {
        header("Location: {$_SERVER['HTTP_REFERER']}");
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        // $pengacak = '2812AaRrYuHgBnMk';
        // $acakpass = md5($pengacak.md5($pengacak.md5($_POST['password']).$pengacak).$pengacak);

        if (($username == "admin" AND $password == "admin") OR ($username == "kasir" AND $password == "kasir") OR ($username == "input" AND $password == "input"))
        {
            echo '<script>$("#login").addClass("animated fadeOutUp");</script> ';
            $_SESSION['username'] = $username;
            // $_SESSION['password'] = $value['Nama'];
            $_SESSION['status'] = ($username == "admin" ? 1 : ($username == "kasir" ? 2 : 3));
            // $_SESSION['status'] = $value['Level'];
            model::movingPage('dashboard');
        }
        else
        {
            ?>
            <script>$("#login").addClass("animated shake");</script>
            <script>alert('Username / Password yang anda masukan salah!');</script>
            <?php
        }
    }

    public static function movingPage($page)
    {
        ?>
        <meta http-equiv="refresh" content="0;url=?control=<?php echo $page; ?>">
        <?php
//			header("location:?control=".$page);
    }

    public function sessionPage($page)
    {
        $check = $this->cekSession();
        if ($check == true)
        {
            if (isset($_GET['control']))
            {
                $link = $_GET['control'];
            }
            if ($link == 'barang' OR $link == 'dashboard' OR $link == 'transaksi')
            {
                require_once($page);
            }
            else
            {
                require_once("application/view/not-found.php");
            }
        }
        else
        {
            model::viewCekSession();
        }
    }

    public function cekSession()
    {
        if (isset($_SESSION['username']))
        {
            return true;
        }
        elseif (!isset($_SESSION['username']))
        {
            return false;
        }
    }

    public function viewCekSession()
    {
        if (model::cekSession() == true)
        {
            require_once('application/view/daskboard.php');
        }
        elseif (model::cekSession() == false)
        {
            require_once('application/view/login.php');
            model::movingPage('login');
        }
    }

    public function logout()
    {
        if (isset($_SESSION['username']))
        {
            session_destroy();
        }
    }

    public function getDataWhere($table, $where)
    {
        $query = model::select_where($table, $where);
        $data = mysql_fetch_array($query);
        return $data;
    }

    public function getAllDataCount($field, $table)
    {
        $array = array();
        $query = model::query("SELECT COUNT($field) as total FROM $table");
        while ($row = mysql_fetch_array($query))
        {
            $array[] = $row;
        }
        // echo ("SELECT *, COUNT($field) FROM $table");
        return $array;
    }

    public function getAllData($table)
    {
        $array = array();
        $query = model::select($table);
        while ($row = mysql_fetch_array($query))
        {
            $array[] = $row;
        }
        return $array;
    }

    public function select($table)
    {
        $query = model::query("SELECT * FROM $table");
        return $query;
    }
//        public function getFieldTable($table) {
//            $result = array();
//            $sql = mysql_query("SELECT * FROM ".$table);
//            $i = 0;
//            while ($i < mysql_num_fields($sql)) {
//                $meta = mysql_fetch_field($sql, $i);
//                $result[] =  $meta->name;
//                $i++;
//            }
//            return $result;
//        }

    public function totalData($table)
    {
        $query = model::query("SELECT * FROM $table");
        $result = mysql_num_rows($query);
        return $result;
    }

    public function totalDataWhere($table, $where)
    {
        $query = model::query("SELECT * FROM $table WHERE $where");
        $result = mysql_num_rows($query);
        return $result;
    }

    public function search($table, $key)
    {
        $result = model::query("SELECT * FROM $table WHERE id='$key'");
        $getResult = mysql_fetch_assoc($result);
        return $getResult;
    }

    public function search_detail($table, $key)
    {
        $array = array();
        $result = model::query("SELECT * FROM $table WHERE id_transaksi='$key'");
        while ($getResult = mysql_fetch_assoc($result))
        {
            $array[] = $getResult;
        }
        return $array;
    }

    public function searchmoretable($table, $key, $condition, $sort)
    {
        $kunci = str_replace("'", "", $key);
        $array = array();
        $query = model::query("SELECT * FROM $table");
        $where = "WHERE " . $condition . " (";
        while ($value = mysql_fetch_field($query))
        {
            $where .= $value->table . "." . $value->name . " LIKE '%" . $kunci . "%' OR ";
        }
        $where = rtrim($where, ' OR ');
        $where .= ")";
        $result = model::query("SELECT * FROM $table $where $sort");
        while ($getResult = mysql_fetch_array($result))
        {
            //echo "SELECT * FROM $table $where $sort";
            $array[] = $getResult;
        }

        return $array;
    }
    // public function pagging($table) {
    // 	$per_page = 20;
    // 	$totalData = model::totalData($table);
    // 	$totalPage = ceil($totalData / $per_page);
    // 	if (isset($_GET['page'])) {
    //   		$show_page = $_GET['page']; //current page
    //     	if ($show_page > 0 && $show_page <= $totalPage) {
    // 	        $start = ($show_page - 1) * $per_page;
    // 	        $end = $start + $per_page;
    //     	}
    //     	else {
    // 	        // error - show first set of results
    // 	        $start = 0;
    // 	        $end = $per_page;
    //     	}
    // 	}
    // 	else {
    // 		// if page isn't set, show first set of results
    // 		$start = 0;
    // 		$end = $per_page;
    // 	}
    // 	// display pagination
    // 	$page = intval($_GET['page']);
    // 	$tpages=$totalPage;
    // 	if ($page <= 0) {
    // 	    $page = 1;
    // 	}
    // 	echo $start;
    // 	echo $end;

    // }
}

?>