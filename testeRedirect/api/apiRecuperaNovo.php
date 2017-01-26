<?php
      require_once 'conexao.php';

      $token = $_POST['token'];
      $user = $_POST['user'];
      $pass = $_POST['pass'];

    if ($token === "1f3d2gs3f2fg3as2fdg3re2t1we46er45") {

            $sql = "SELECT * FROM  usuarios WHERE login = :login AND senha = :senha";
            $exec = $con->prepare($sql);
            $exec->bindParam(':login', $user);
            $exec->bindParam(':senha', $pass);
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
