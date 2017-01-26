<?php
header('Content-type: text/javascript');
$FILE = "contador.txt";
$IMG_DIR = "http://www.passosdoesporte.com.br/numeros/";
$n_digitos = 4;
if (file_exists($FILE)) {
$fp = fopen("$FILE", "r+");
flock($fp, 1);
$count = fgets($fp, 4096);
$count += 1;
fseek($fp,0);
fputs($fp, $count);
flock($fp, 3);
fclose($fp);
} else {
echo "document.write(\"não consigo encontrar o ficheiro, check '\$file' var...\")";
exit;
}
chop($count);
$n_digitos = max(strlen($count), $n_digitos);
$count = substr("0000000000".$count, -$n_digitos);
$digits = preg_split("//", $count);
for($i = 0; $i <= $n_digitos; $i++) {
if ($digits[$i] != "") {
$html_result .= "<IMG SRC=\\\"".$IMG_DIR.$digits[$i].".png\\\">";
}
}
echo "document.write(\"".$html_result."\");";
?>