<?php
/// $Id: mod_gifcontador.php, v1.0 2007/02/27 
/**
* Contador de visitas con numeros en formato gif.
* @ Released under GNU/GPL License : http://www.gnu.org/copyleft/gpl.html
* @ Author : Paco Cuadra
* @ version $Revision: 1.0 $
* Para cambiar los numeros, simplemente hay que sustituir los ficheros images/numeros/n1.gif .. n0.gif 
* por los deseados que se muestren.
* Es necesario tener habilitadas las estadisticas, ya que el contador toma el numero de 
* visitas de las estadisticas.
**/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


		$inicial = $params->get( 'contador_ini' );

		$query = "SELECT sum(hits) AS count FROM #__stats_agents WHERE type='1'";
		$database->setQuery( $query );
		$hits = $database->loadResult();

            $hits = 100000 + $hits + $inicial;
            $hits = substr($hits,1,5);            
            print ("<left>");
            for ($i = 0;$i <5; $i++) {
               $nu=substr($hits,$i,1);
               print ("<img src='modules/numeros/n$nu.gif'>");
            }            
            print ("</left>");            
?>

