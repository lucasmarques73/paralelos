<?php

        require_once 'conexao.php';

        $query = "SELECT * FROM usuarios ORDER BY nome";

        $exec = $con->prepare($query);
        $exec->execute();


        while($row=$exec->fetch(PDO::FETCH_ASSOC)){
                $vetor[] = $row ;
        }

        echo json_encode($vetor,JSON_UNESCAPED_UNICODE);
?>
