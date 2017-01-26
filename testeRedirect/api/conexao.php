<?php

        header("Access-Control-Allow-Origin: *");
        header('Content-Type: text/html; charset=utf-8');

        $dns = "mysql:host=mysql.hostinger.com.br;dbname=u757246303_bdloc";
        $user = 'u757246303_bdloc';
        $pass = 'lucas2507';

        try {
                $con = new PDO($dns, $user, $pass);

                if(!$con){
                          echo "Não foi possivel conectar com Banco de Dados!";
                }

        } catch (Exception $e) {
        	echo "Erro: ". $e->getMessage();
        };

?>
