<?php
      require_once 'conexao.php';

      $name = "Marcelo";
      $user = "marcelo";
      $pass = "123";

      $name = stripslashes($name);
      $user = stripslashes($user);
      $pass = stripslashes($pass);

      $name = trim($name);
      $user = trim($user);
      $pass = trim($pass);


      $sql = "call insereUsuario( :nome, :login, :senha)";
      $exec = $con->prepare($sql);
      $exec->bindParam(':nome', $name);
      $exec->bindParam(':login', $user);
      $exec->bindParam(':senha', $pass);
      $exec->execute();

      while($row=$exec->fetch(PDO::FETCH_ASSOC)){
              $vetor[] = $row ;
      }

      echo json_encode($vetor,JSON_UNESCAPED_UNICODE);




?>
