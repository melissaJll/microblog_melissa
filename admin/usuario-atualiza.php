<?php

use Microblog\Usuario;

require_once "../inc/cabecalho-admin.php";
$sessao->verificaAcessoAdmin();

//Script de vizualização
$usuario = new Usuario;
$usuario->setId($_GET["id"]);
$umUsuario = $usuario->listarUm(); //Vem do Banco
$listaUsuarios = $usuario->listar();

//Script de atualização
if(isset($_POST['atualizar'])){
    $usuario->setNome($_POST['nome']); //Vem do Formulário
    $usuario->setEmail($_POST['email']);
    $usuario->setTipo($_POST['tipo']);

	/* Algoritmo geral para tratamento de senha */
	/* Se o campo senha no formulário estiver vazio, significa que o usuario não mudou a senha */
	if(empty($_POST['senha'])){ //Caso 1: deixa vazio
		/* Portanto passamos a senha já existente no banco de dados $umUsuario['senha'] para o objeto através do setSenha, sem qualquer alteração */
		$usuario->setSenha($umUsuario['senha']);
	}else{ //caso 2 e 3
		/*Caso contrário, se o usuario digitou alguma coisa no campo, precisaremos verificar o que foi digitado*/
		$usuario->setSenha(
			$usuario->verificaSenha($_POST['senha'], $umUsuario['senha'])
		);
	}

	$usuario->atualizar();
	header("location:usuarios.php");
}
?>

<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Atualizar dados do usuário
		</h2>
				
		<form class="mx-auto w-75" action="" method="post" id="form-atualizar" name="form-atualizar">

			<div class="mb-3">
				<label class="form-label" for="nome">Nome:</label>
				<input value="<?=$umUsuario['nome']?>" class="form-control" type="text" id="nome" name="nome" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="email">E-mail:</label>
				<input value="<?=$umUsuario['email']?>" class="form-control" type="email" id="email" name="email" required>
			</div>

			<div class="mb-3">
				<label class="form-label" for="senha">Senha:</label>
				<input class="form-control" type="password" id="senha" name="senha" placeholder="Preencha apenas se for alterar">
			</div>

			<div class="mb-3">
				<label class="form-label" for="tipo">Tipo:</label>
				<select class="form-select" name="tipo" id="tipo" required>
					<option value=""></option>

					<option <?php if($umUsuario['tipo'] == "editor")
						echo " selected ";?> value="editor">Editor</option>
					<option <?php if($umUsuario['tipo'] == "admin")
						echo " selected ";?> value="admin">Administrador</option>
				</select>
			</div>
			
			<button class="btn btn-primary" name="atualizar"><i class="bi bi-arrow-clockwise"></i> Atualizar</button>
		</form>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

