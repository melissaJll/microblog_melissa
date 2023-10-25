<?php 
require_once "../inc/cabecalho-admin.php";

use Microblog\Noticia;
use Microblog\Utilitarios;

$noticia = new Noticia;

// capturando o id e tipo do user logado
$noticia->usuario->setId($_SESSION['id']);
$noticia->usuario->setTipo($_SESSION["tipo"]);

$listaNoticias = $noticia->listar();

?>


<div class="row">
	<article class="col-12 bg-white rounded shadow my-1 py-4">
		
		<h2 class="text-center">
		Notícias <span class="badge bg-dark"><?=count($listaNoticias)?></span>
		</h2>

		<p class="text-center mt-5">
			<a class="btn btn-primary" href="noticia-insere.php">
			<i class="bi bi-plus-circle"></i>	
			Inserir nova notícia</a>
		</p>
				
		<div class="table-responsive">
		
			<table class="table table-hover">
				<thead class="table-light">
					<tr>
                        <th>Título</th>
                        <th>Data</th>

						<?php if($_SESSION["tipo"]  === "admin"){?>
                        	<th>Autor</th>
						<?php } ?>

						<th>Destaque</th>
						<th class="text-center" colspan="2">Operações</th>
					</tr>
				</thead>

				<tbody>
				<?php foreach($listaNoticias as $itemNoticia){?>
					<tr>
                        <td><?=$itemNoticia["titulo"]?></td>
                        <td><?=$itemNoticia["data"]?></td>
						<?php if($_SESSION["tipo"]  === "admin"){?>
                        	<td> <?=$itemNoticia["autor"]?></td>
						<?php } ?>
                        <td><?=$itemNoticia["destaque"]?></td>
						<td class="text-center">
							<a class="btn btn-warning" 
							href="noticia-atualiza.php?id=<?=$itemNoticia["id"]?>">
							<i class="bi bi-pencil"></i> Atualizar
							</a>
						
							<a class="btn btn-danger excluir" 
							href="noticia-exclui.php?id=<?=$itemNoticia["id"]?>">
							<i class="bi bi-trash"></i> Excluir
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>                
			</table>
	</div>
		
	</article>
</div>


<?php 
require_once "../inc/rodape-admin.php";
?>

