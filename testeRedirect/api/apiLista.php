<?php
      require_once 'conexao.php';

        $token = $_POST['token'];


    if ($token === "1f3d2gs3f2fg3as2fdg3re2t1we46er45") {

            $sql = "SELECT * FROM  usuarios ORDER BY nome";
            $exec = $con->prepare($sql);
            $exec->execute();

            while($row=$exec->fetch(PDO::FETCH_ASSOC)){
                    $vetor[] = $row ;
            }

            echo json_encode($vetor,JSON_UNESCAPED_UNICODE);
    }
    else{
      echo "Erro ao conectar com o banco!";
    }





?>
