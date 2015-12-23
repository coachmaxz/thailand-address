<?php

header('Content-Type: text/html; charset=utf-8');

include_once 'include/setting.php'; 
include_once 'include/connect.db.php'; 

if (!empty($_GET['action'])) {
    
    if ($_GET['action'] == 'province') {
		
		if ($mode == 'MYSQL') {
			$provinceSelect = 'SELECT PROVINCE_ID,PROVINCE_NAME FROM ' . $tbl_province . ' ORDER BY PROVINCE_ID ASC';
			$provinceResult = mysql_query($provinceSelect, $conn) or die('Could not connect: ' . mysql_error());
			$provinceRows = mysql_num_rows($provinceResult);
			if ($provinceRows != 0) {
				echo '<option value="">--- เลือก จังหวัด ---</option>';
				while ($province = mysql_fetch_array($provinceResult, MYSQL_ASSOC)) {
					echo '<option value="'.$province['PROVINCE_ID'].'">' . trim($province['PROVINCE_NAME']) . '</option>';
				}
			} else {
				echo '<option value="">--- เลือก จังหวัด ---</option>';
			}
		}
		
		if ($mode == 'PDO_MYSQL') {
			$provinceResult = $conn->query('SELECT PROVINCE_ID,PROVINCE_NAME FROM ' . $tbl_province . ' ORDER BY PROVINCE_ID ASC');
			$provinceResult->setFetchMode(PDO::FETCH_ASSOC); // PDO::FETCH_ASSOC, PDO::FETCH_OBJ
			if ($provinceResult->rowCount() > 0) {
				echo '<option value="">--- เลือก จังหวัด ---</option>';
				while($province = $provinceResult->fetch()) {
					echo '<option value="'.$province['PROVINCE_ID'].'">' . trim($province['PROVINCE_NAME']) . '</option>';
				}
			} else {
				echo '<option value="">--- เลือก จังหวัด ---</option>';
			}
		}
		
    } 
	
    if ($_GET['action'] == 'amphur' && !empty($_GET['province_id'])) {
		
		if ($mode == 'MYSQL') {
			$amphurSelect = 'SELECT * FROM ' . $tbl_amphur . ' WHERE PROVINCE_ID = ' . trim($_GET['province_id']) . ' ORDER BY AMPHUR_ID ASC';
			$amphurResult = mysql_query($amphurSelect, $conn) or die('Could not connect: ' . mysql_error());
			$amphurRows = mysql_num_rows($amphurResult);
			if ($amphurRows != 0) {
				echo '<option value="">--- เลือก อำเภอ ---</option>';
				while ($amphur = mysql_fetch_array($amphurResult, MYSQL_ASSOC)) {
					echo '<option value="'.$amphur['AMPHUR_ID'].'">' . trim($amphur['AMPHUR_NAME']) . '</option>';
				}
			} else {
				echo '<option value="">--- เลือก อำเภอ ---</option>';
			}
			
		}
		
		if ($mode == 'PDO_MYSQL') {
			$amphurResult = $conn->prepare('SELECT * FROM ' . $tbl_amphur . ' WHERE PROVINCE_ID = :province_id ORDER BY AMPHUR_ID ASC');
			$amphurResult->bindParam(':province_id', trim($_GET['province_id']));
			$amphurResult->execute();
			if ($amphurResult->rowCount() > 0) {
				echo '<option value="">--- เลือก อำเภอ ---</option>';
				while ($amphur = $amphurResult->fetch()) {
					echo '<option value="'.$amphur['AMPHUR_ID'].'">' . trim($amphur['AMPHUR_NAME']) . '</option>';
				}
			} else {
				echo '<option value="">--- เลือก อำเภอ ---</option>';
			} 
		}
		
    }
    
    if ($_GET['action'] == 'district' && !empty($_GET['amphur_id'])) {
		
		if ($mode == 'MYSQL') {
			$districtSelect = 'SELECT DISTRICT_ID,DISTRICT_NAME FROM ' . $tbl_district . ' WHERE AMPHUR_ID = ' . trim($_GET['amphur_id']) . ' ORDER BY DISTRICT_ID ASC';
			$districtResult = mysql_query($districtSelect, $conn) or die('Could not connect: ' . mysql_error());
			$districtRows = mysql_num_rows($districtResult);
			if ($districtRows != 0) {
				echo '<option value="">--- เลือก ตำบล ---</option>';
				while ($district = mysql_fetch_array($districtResult, MYSQL_ASSOC)) {
					echo '<option value="'.$district['DISTRICT_ID'].'">' . trim($district['DISTRICT_NAME']) . '</option>';
				}
			} else {
				echo '<option value="">--- เลือก ตำบล ---</option>';
			}
		}
		
		if ($mode == 'PDO_MYSQL') {
			$districtResult = $conn->prepare('SELECT DISTRICT_ID,DISTRICT_NAME FROM ' . $tbl_district . ' WHERE AMPHUR_ID = :amphur_id ORDER BY DISTRICT_ID ASC');
			$districtResult->bindParam(':amphur_id', trim($_GET['amphur_id']));
			$districtResult->execute();
			if ($districtResult->rowCount() > 0) {
				echo '<option value="">--- เลือก ตำบล ---</option>';
				while ($district = $districtResult->fetch()) {
					echo '<option value="'.$district['DISTRICT_ID'].'">' . trim($district['DISTRICT_NAME']) . '</option>';
				}
			} else {
				echo '<option value="">--- เลือก ตำบล ---</option>';
			} 
		}
		
    }
    
    if ($_GET['action'] == 'post' && !empty($_GET['amphur_id'])) {
		
		if ($mode == 'MYSQL') {
			$postSelect = 'SELECT POSTCODE FROM ' . $tbl_amphur . ' WHERE AMPHUR_ID = ' . trim($_GET['amphur_id']) . ' ORDER BY AMPHUR_ID ASC LIMIT 1';
			$postResult = mysql_query($postSelect, $conn) or die('Could not connect: ' . mysql_error());
			$postRows = mysql_num_rows($postResult);
			if ($postRows != 0) {
				$post = mysql_fetch_array($postResult, MYSQL_ASSOC);
				if (!empty($post)) {
					echo $post['POSTCODE'];
				}
			}
		}
		
		if ($mode == 'PDO_MYSQL') {
			$postResult = $conn->prepare('SELECT POSTCODE FROM ' . $tbl_amphur . ' WHERE AMPHUR_ID = :amphur_id ORDER BY AMPHUR_ID ASC LIMIT 1');
			$postResult->bindParam(':amphur_id', trim($_GET['amphur_id']));
			$postResult->execute();
			if ($postResult->rowCount() > 0) {
				$post = $postResult->fetch();
				if (!empty($post)) {
					echo $post['POSTCODE'];
				}
			} 
		}
		
    }
	
}

include_once 'include/disconnect.db.php'; 

exit();