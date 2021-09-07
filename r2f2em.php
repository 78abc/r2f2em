<?php
/*


R2F2EM Json Database Class.


*/

error_reporting(E_ALL ^ E_ALL);

class r2f2em{
public $veri;
public $yuklenen_veri;
public $veriarray;
public $sonid;
public $bol;
public $new_number;
public $new_son_id;
public $veri_sayili;
public $sonveri;
public $file;
public $filenameofjsonfile;
public $var_name_of_new_array;
public $variable_name_of_thing_that_you_want;
public $dosyaverisi;
public $getname;
public $dosyaverisiprint;
public $getnameprint;
public $hedef_id;
public $guncellemeyle_eklenecek_veri;
public $hedefid;
public $guncellenecek_veri;
public $dosyaicerigi;
public $aranan;
public $get_id_son;
public $number_hedef;
public $bir_sonraki_id;
public $bir_sonraki_aranan;
public $degistirilecek_jsn;
public $find_x;
public $fin_y;
public $update_son_hali;
public $cr_array;
public $verisonid;
public $sonid_crr;
public $verisonidnumber;
public $hedef_th;
public $degistirilecek_jsn_n;
public $update_son_hali_n;
public $sorgu_x;
public $original_database_json_text;
public $verianahtaridegeri;
public $verianahtari;
public $olustur;
public $hedeftekiverianahtari;
public $hedefteki_veri_anahtari;
public $olustur_n_va;
public $find_n_va_key;
public $newgetname;
public $dosyadecodeicerigi;
public $database_text;
function __construct($filenameofjsonfile){
$this->file = $filenameofjsonfile;

if(!file_exists($this->file)){
	touch($this->file);
}

$this->dosyaicerigi = file_get_contents($this->file);
$sorgu_x = str_replace("sonidDIGERVERILERLEKARISMASINDDJCEWUN", "", $this->dosyaicerigi);
if($sorgu_x=="$this->dosyaicerigi"){
	$this->database_text = '{"sonid": "sonidDIGERVERILERLEKARISMASINDDJCEWUN0", "descriptionofdatabase": {"tr": {"aciklama": "Bu veritabanı, json formatında herkese açık bir veritabanıdır."}}}';
	$original_database_json_text = '{"sonid": "sonidDIGERVERILERLEKARISMASINDDJCEWUN0", "descriptionofdatabase": {"tr": {"aciklama": "Bu veritabanı, json formatında herkese açık bir veritabanıdır."}}}';
	file_put_contents($this->file, $original_database_json_text);
}
$cr_array = json_decode($this->dosyaicerigi);
$this->dosyadecodeicerigi = $cr_array;
$this->verisonid = $cr_array->sonid;
$sonid_crr = explode("sonidDIGERVERILERLEKARISMASINDDJCEWUN", $this->verisonid);
$this->verisonidnumber = $sonid_crr[1];
}

function add($var_name_of_new_array){
$this->yuklenen_veri = $var_name_of_new_array;

$veri = file_get_contents($this->file);
$veriarray = json_decode($veri);
$sonid = $veriarray->sonid;
$bol = explode("sonidDIGERVERILERLEKARISMASINDDJCEWUN", $sonid);
$new_number = $bol[1] + 1;
$new_son_id = "sonidDIGERVERILERLEKARISMASINDDJCEWUN" . "$new_number";
$veri = str_replace($sonid, $new_son_id, $veri);
$veri = substr($veri, 0, -1);
$veri = ltrim($veri, "{");
$veri = $veri . ", ";



$veri_sayili = '"id' . $new_number . '"';
$this->yuklenen_veri = json_encode($this->yuklenen_veri, JSON_UNESCAPED_UNICODE);
$this->yuklenen_veri = ''.$veri_sayili.': ' . $this->yuklenen_veri;
$sonveri = "$veri" . " " . "$this->yuklenen_veri";
$sonveri = "{" . "$sonveri" . "}";
file_put_contents($this->file, $sonveri);
return str_replace('"', '', $veri_sayili);
}

function get($variable_name_of_thing_that_you_want){
$this->getname = $variable_name_of_thing_that_you_want;
$this->dosyaverisi = json_decode(file_get_contents($this->file));
$dosyaverisiprint = $this->dosyaverisi;
$getnameprint = $this->getname;
if(empty($getnameprint)){
	return $dosyaverisiprint;
}else{
return $dosyaverisiprint->$getnameprint;
}
}



function update($hedef_id, $guncellemeyle_eklenecek_veri){
$this->hedefid = $hedef_id;
$this->guncellenecek_veri = $guncellemeyle_eklenecek_veri; //array
$get_id_son = explode("d", $this->hedefid);
$number_hedef = $get_id_son[1] + 1;
$bir_sonraki_id = "id" . $number_hedef;
$aranan = '"'. $this->hedefid . '": '; 
$bir_sonraki_aranan = '"' . $bir_sonraki_id . '": ';

if($this->verisonidnumber=="$get_id_son[1]"){

	$hedef_th = explode($aranan, $this->dosyaicerigi);
	$hedef_th = substr($hedef_th[1], 0, -1);
   	$hedef_th = $aranan . $hedef_th;
    $degistirilecek_jsn_n = json_encode($this->guncellenecek_veri, JSON_UNESCAPED_UNICODE);
  	$degistirilecek_jsn_n = $aranan . $degistirilecek_jsn_n;
	$update_son_hali_n = str_replace($hedef_th, $degistirilecek_jsn_n, $this->dosyaicerigi);
	file_put_contents($this->file, $update_son_hali_n);

}else{
	$degistirilecek_jsn = json_encode($this->guncellenecek_veri, JSON_UNESCAPED_UNICODE);
 	$degistirilecek_jsn = $degistirilecek_jsn . ", ";
	$degistirilecek_jsn = $aranan . $degistirilecek_jsn;
	$find_x = explode($aranan, $this->dosyaicerigi);
	$find_y = explode($bir_sonraki_aranan, $find_x[1]);
	$find_y = $aranan . $find_y[0];
    $update_son_hali = str_replace($find_y, $degistirilecek_jsn, $this->dosyaicerigi);
	file_put_contents($this->file, $update_son_hali);
}
}



function select($secilecek_veri_anahtari, $veri_anahtari_degeri){

$this->verianahtari = $secilecek_veri_anahtari;
$this->verianahtaridegeri = $veri_anahtari_degeri;
$olustur = '"' . $this->verianahtari . '":"' . $this->verianahtaridegeri . '"';

 function ara($bas, $son, $yazi){
    @preg_match_all('/' . preg_quote($bas, '/') .
    '(.*?)'. preg_quote($son, '/').'/i', $yazi, $m);
    return @$m[1];
}

$find_x_key = ara($olustur, "}", $this->dosyaicerigi);
foreach($find_x_key as $item){
	$itemolustur = '{' . $olustur . $item . '}';
	$itemolustur = json_decode($itemolustur);
	$create_new_array[] = $itemolustur; 
}

return $create_new_array;

}



function find($hedefteki_veri_anahtari){


$this->hedeftekiverianahtari = $hedefteki_veri_anahtari;
$hedef_anahtar_pb = $this->hedeftekiverianahtari;
$number_bi_fazla = $this->verisonidnumber + 1;
for($i=1;$i<$number_bi_fazla;$i++){
$id_text = 'id' . $i;
	$control_x = $this->dosyadecodeicerigi->$id_text;
	if(!empty($control_x->$hedefteki_veri_anahtari)){
		$n_n_va = '{"id":"id' . $i . '","';
		$str_n = str_replace('{"', $n_n_va, json_encode($control_x, JSON_UNESCAPED_UNICODE));
		$create_new_array_n_va[] = json_decode($str_n);
	}
}
return $create_new_array_n_va;

}

function drop(){

file_put_contents($this->file, $this->database_text);

return "Database reset";

}
}
