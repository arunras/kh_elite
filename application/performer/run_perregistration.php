<?php
	ob_start();
    if(!isset($_SESSION))session_start();
	
	if(!defined("per_sub_path"))define("per_sub_path",dirname(dirname(dirname(__FILE__))));
	require_once(per_sub_path . "/module/module.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."/" . ROOT . "/module/module.php");
	
	if(getCurrentUser()==0 || getUserType()!=ADMINISTRATOR){ //getCurrentUser()!=$_GET['perid'] ||
		//require_once($_SERVER['DOCUMENT_ROOT'] . "/rakugo/include/hacker.php");
		echo '<script type="text/javascript">';
			echo 'window.location.href="?page=index"';
		echo '</script>';
		exit();
	}

	echo '<link rel="stylesheet" href="'.HTTP_DOMAIN.'application/performer/css/s_performer.css" type="text/css" />';
	echo '<script src="'.HTTP_DOMAIN.'application/_formvalidation/js/jquery-latest.js"></script>';
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'application/_formvalidation/js/jquery.validate.js"></script>';
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'application/_formvalidation/js/run_formvalidation.js"></script>';
	echo '<script type="text/javascript" src="'.HTTP_DOMAIN.'application/performer/js/birthdate.js"></script>';
	echo '<link type="text/css" rel="stylesheet" href="'.HTTP_DOMAIN.'application/_formvalidation/css/s_formvalidation.css">';

?>
<script type="text/javascript">
	function submitRegistration(){
    		$('form#iform_newperformer').submit();
	}

	function submitSuccess(per_id){
		$('div img.isending').show();
		var alert_text = $('div.Lmessages span#ialertcomplet').html();
		alert(alert_text);
		<?php if($_SESSION['language_selected']=='ja'){$_SESSION['language_selected']='';}?>
		window.location.href="<?php echo '../../../'.$_SESSION['language_selected'];?>" + "?page=perprofile&perid=" + per_id;
		//header('Location:../../../'.$_SESSION['language_selected'].'?page=perprofile&perid='.$per_id);
	}
	function goBack(){
		 history.back();
	}
</script>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/" . ROOT . "/application/performer/class/performer.class.php");

//form_PerRegistration();
//function form_PerRegistration(){
$per = new performer();
		echo '<h2>'.$rLanguage->text("Add New Performer").'</h2>';
		//'.HTTP_DOMAIN.'application/performer/php_sub/r_performeradd.php
		echo '<form action="'.HTTP_DOMAIN.'application/performer/php_sub/r_performeradd.php" id="iform_newperformer" method="post" enctype="multipart/form-data" onsubmit="return file_validation()" target="whensuccess">';
		echo '<div class="form_perregistration">';
			echo '<table border="1" width="100%">';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Name*").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="text" id="iname" name="pername" class="textbox" autofocus="autofocus"/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Date of Birth").' :';
					echo '</td>';
					echo '<td>';
						//echo '<input type="text" id="idob" name="perdob" class="textbox"/>';
						echo '<select id="year" name="yyyy">';
						echo '</select><span style="margin-right: 5px;">年</span>';
						echo '<select id="month" name="mm">';
						echo '</select><span style="margin-right: 5px;">月</span>';
						echo '<select id="date" name="dd">';
						echo '</select><span style="margin-right: 5px;">日</span>';
						echo '<script type="text/javascript">date_populate("date", "month", "year");</script>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Hometown").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="text" id="ihometown" name="perhometown" class="textbox"/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Group").' :';
					echo '</td>';
					echo '<td>';
						//echo '<input type="text" id="igroup" name="pergroup" class="textbox"/>';
						echo '<select id="igroup" name="pergroup">';
							$q_group = getResultSet("SELECT group_id, group_name FROM tbl_group");
							while($rg = mysql_fetch_array($q_group))
							{
								$group_id = $rg['group_id'];
								$group_name = $rg['group_name'];
								echo '<option value="'.$group_id.'">'.$group_name.'</option>';
							}
						echo '</select>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Teacher").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="text" id="iteacher" name="perteacher" class="textbox"/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Theme song").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="text" id="isong" name="persong" class="textbox"/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label" style="vertical-align: top;">';
						echo ''.$rLanguage->text("Best story").' :';
					echo '</td>';
					echo '<td>';
						//echo '<input type="text" id="istory" name="perstory" class="textbox"/>';
						echo '<textarea id="istory" rows="3" name="perstory" class="textarea"></textarea>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Homepage").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="text" id="iurl" name="perurl" class="textbox" value=""/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Twitter ID").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="text" id="itwitter" name="pertwitter" class="textbox" value=""/>';
					echo '</td>';	
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Mail Address*").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="text" id="iemail" name="peremail" class="textbox"/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Upload").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="file" id="perpicture" name="perpicture" class="textbox"/>';
						echo '<input type="hidden" value="2000000" name="MAX_FILE_SIZE" />';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label"></td>';
					echo '<td>';
						echo '<span class="tip">※アップロードした画像は、噺家プロフィール画面とトップページのピックアップに表示されます。</span>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Password*").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="password" id="ipassword" name="perpassword" class="textbox"/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
						echo ''.$rLanguage->text("Confirm*").' :';
					echo '</td>';
					echo '<td>';
						echo '<input type="password" id="iconfirm" name="perconfirm" class="textbox"/>';
					echo '</td>';
				echo '</tr>';
				echo '<tr>';
					echo '<td class="label">';
					echo '</td>';
					echo '<td align="left">';
						//echo '<input type="button" id="iadd_performer" name="persubmit" value="Register" onclick="add_newperformer()"/>';
						
						//echo '<input class="submit btn" type="submit" id="iadd_performer" name="btn_add" value="Register" style="margin-left: 0px;">';
						echo '<div class="submit button pink" style="float: left; margin-top: 5px;" onclick="submitRegistration();"><label style="width: 80px;">'.$rLanguage->text("Register").'</label><span></span></div>';
						echo '<div class="submit button pink" style="float: left; margin-top: 5px;" onclick="goBack()"><label style="width: 80px;">'.$rLanguage->text("Cancel").'</label><span></span></div>';
						echo '<div style="float: left; margin-top: 5px; width: 165px; height: 25px; font-size: 15px; padding: 8px 5px 5px 10px;"><img class="isending" src="'.HTTP_DOMAIN.'images/isending.gif" style="display:none;"></img></div>';
						//*echo '<span id="ialertcomplet">'.$rLanguage->text("Registration Complete").'</span>';
					echo '</td>';
				echo '</tr>';
			echo '</table>';
			echo '</div>';
		echo '</form>';
	
		echo '<iframe id="whensuccess" name="whensuccess" style="display:none;"></iframe>';
		/*==Messages===========================================================*/

		echo '<div class="Lmessages">';
			echo '<span id="ialertcomplet">'.$rLanguage->text("Registration Complete").'</span>';
			echo '<span id="ismsrequired">'.$rLanguage->text("This field is required").'</span>';
			echo '<span id="ismsurl">'.$rLanguage->text("Please enter a valid URL").'</span>';
			echo '<span id="ismsemail">'.$rLanguage->text("Please enter a valid email address").'</span>';
			echo '<span id="ismsequalTo">'.$rLanguage->text("Please enter the same value again").'</span>';
		echo '</div>';

		/*==Messages===========================================================*/
		
//	}
?>