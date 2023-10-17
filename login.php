<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;
use Microblog\Utilitarios;

require_once "inc/cabecalho.php";


// Mensagens de feedback do login
if(isset($_GET["campos_obrigatorios"]) ){
	$feedback = "Você deve preecher email e senha!";
}elseif(isset($_GET["dados_incorretos"])){
	$feedback = "Dados Incorretos";
}

?>


<div class="row">
    <div class="bg-white rounded shadow col-12 my-1 py-4">
        <h2 class="text-center fw-light">Acesso à área administrativa</h2>

        <form action="" method="post" id="form-login" name="form-login" class="mx-auto w-50">

                <!-- mensagens -->
				<?php if(isset($feedback)){?>
					<p class="my-2 alert alert-warning text-center"><?=$feedback?></p>
				<?php } ?>

				<div class="mb-3">
					<label for="email" class="form-label">E-mail:</label>
					<input class="form-control" type="email" id="email" name="email">
				</div>
				<div class="mb-3">
					<label for="senha" class="form-label">Senha:</label>
					<input class="form-control" type="password" id="senha" name="senha">
				</div>

				<button class="btn btn-primary btn-lg" name="entrar" type="submit">Entrar</button>

			</form>

			<?php
			if(isset($_POST['entrar'])){
				//Verifica se os campos foram preechidos
				if (empty($_POST['email']) || empty($_POST['senha']) ) {
					header("location:login.php?campos_obrigatorios");
				} else {
					//Capturar email
					$usuario = new Usuario;
					$usuario->setEmail($_POST["email"]);

					//Buscar o email no banco de dados
					$dados = $usuario->buscar();

					//Se não existir $dados(o email não existir retorna false), continuará em login.php
					//if($dados === false)
					if(!$dados){
						header("location:login.php?dados_incorretos");
					}else{
					//Se existir
						//verificar a senha
						// se estiver correta, iniciar processo de login
						if (password_verify($_POST['senha'], $dados['senha'])) {
							echo "Senha correta";
						}
						//Não está corretta, constinuará em login
						else{
							echo "Senha Incorreta";				
						}
						
					}
				}
				
			}
			
			?>


    </div>
    
    
</div>        
        
        
    



<?php 
require_once "inc/rodape.php";
?>

