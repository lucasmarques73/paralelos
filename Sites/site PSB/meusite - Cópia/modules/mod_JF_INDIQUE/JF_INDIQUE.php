<?php




if(count($_POST)) {


foreach(array('fmail1','fmail2','fmail3','email','name','ymessage','refurl') as $key) $_POST[$key] = strip_tags($_POST[$key]);
if(!is_secure($_POST)) { die("Hackers begone");}







$obrigado = "JF_OBRIGADO.htm"; 


$tsubject = "Site indicado por $_POST[name]";



$ttext = "
Olá,

$_POST[ymessage]

Um amigo recomendou este link:
$_POST[refurl]

Esperamos sua visita!

";

@mail("$_POST[fmail1],$_POST[fmail2],$_POST[fmail3]", $tsubject, $ttext, "FROM: $_POST[email]");

header("Location: $obrigado");
exit;

}


function is_secure($ar) {
$reg = "/(Content-Type|Bcc|MIME-Version|Content-Transfer-Encoding)/i";
if(!is_array($ar)) { return preg_match($reg,$ar);}
$incoming = array_values_recursive($ar);
foreach($incoming as $k=>$v) if(preg_match($reg,$v)) return false;
return true;
}

function array_values_recursive($array) {
$arrayValues = array();
foreach ($array as $key=>$value) {
if (is_scalar($value) || is_resource($value)) {
$arrayValues[] = $value;
$arrayValues[] = $key;
}
elseif (is_array($value)) {
$arrayValues[] = $key;
$arrayValues = array_merge($arrayValues, array_values_recursive($value));
}
}
return $arrayValues;
}

?>