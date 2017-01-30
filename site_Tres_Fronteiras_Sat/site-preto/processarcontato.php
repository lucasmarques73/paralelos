<?php
session_start();

if(isset($_POST))
{
	if(isset($_POST['token']) && $_POST['token'] === $_SESSION['token'])
	{
		$token = $_POST['token'];
		if($_SESSION['check'][$token] === false)
		{
			if(isset($_POST['contato']))
			{
				$nome		= htmlentities($_POST['nome']		, ENT_QUOTES, "UTF-8");
				$email		= htmlentities($_POST['email']		, ENT_QUOTES, "UTF-8");
				$telefone	= htmlentities($_POST['telefone']	, ENT_QUOTES, "UTF-8");
				$mensagem	= htmlentities($_POST['mensagem']	, ENT_QUOTES, "UTF-8");

				$msg  = '<b>Nome:</b> ' 	. $nome 	 . '<br>';
				$msg .= '<b>Email:</b> ' 	. $email 	 . '<br>';
				$msg .= '<b>telefone:</b> ' . $telefone  . '<br>';
				$msg .= '<b>Mensagem:</b> ' . $mensagem  . '<br>';

				$headers = "From: ".$email ."\nContent-type: text/html; charset=UTF-8";
				if(mail('lucasmarques@ranor.com.br ', '[CONTATO WEBSITE] Três Fronteiras Sat', $msg, $headers))
				{
					$headers = "From: contato@ranor.com.br \nContent-type: text/html; charset=UTF-8";
					$msg = "Olá {$nome}, esta é uma cópia da mensagem de contato solicito em nosso site. Muito em breve entraremos em contato com você! Nós agradecemos por entrar em contato! <br>Até breve. <br> Equipe Três Fronteiras Sat. <br><br>--------------------<br>" . $msg;
					if(mail($email, 'Contato - Três Fronteiras Sat', $msg, $headers))
					{
						$_SESSION['check'][$token] = true;
						echo "success";
						exit();
					}
					else{
						echo "erro[3]";
						exit();
					}
				}
				else{
					echo "erro[2]";
					exit();
				}
			}
		}
		echo "erro[1]";
	}
}
else{
	echo "a";
}
exit();
