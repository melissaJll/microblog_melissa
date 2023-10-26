<?php

use Microblog\Utilitarios;
//nem Noticia no cabeçalho

require_once "inc/cabecalho.php";
$noticia->setDestaque("sim"); //apenas noticia em destaque
$destaques = $noticia->listarDestaque();

?>


<div class="row my-1 mx-md-n1">
        <!-- INÍCIO Card -->
        <?php foreach($destaques as $umDestaque){?>
		<div class="col-md-6 my-1 px-md-1">
            <article class="card shadow-sm h-100">
                <a href="noticia.php?id=<?=$umDestaque['id']?>" class="card-link">
                    <img src="imagens/<?=$umDestaque['imagem']?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h3 class="fs-4 card-title"><?=$umDestaque['titulo']?></h3>
                        <p class="card-text"><?=$umDestaque['resumo']?></p>
                    </div>
                </a>
            </article>
		</div>
        <?php } ?>
		<!-- FIM Card -->

</div>        
        
            <hr class="my-5 w-50 mx-auto">
        

        <div class="row my-1">
            <div class="col-12 px-md-1">
                <div class="list-group">
                    <h2 class="fs-6 text-center text-muted">Todas as notícias</h2>
                    <a href="noticia.php" class="list-group-item list-group-item-action">
                         <h3 class="fs-6"><time>12/12/2012</time> - Título da notícia</h3>
                        <p>Resumo da notícia</p>
                    </a>
                    <a href="noticia.php" class="list-group-item list-group-item-action">
                         <h3 class="fs-6"><time>12/12/2012</time> - Título da notícia</h3>
                        <p>Resumo da notícia</p>
                    </a>
                    <a href="noticia.php" class="list-group-item list-group-item-action">
                         <h3 class="fs-6"><time>12/12/2012</time> - Título da notícia</h3>
                        <p>Resumo da notícia</p>
                    </a>
                    <a href="noticia.php" class="list-group-item list-group-item-action">
                         <h3 class="fs-6"><time>12/12/2012</time> - Título da notícia</h3>
                        <p>Resumo da notícia</p>
                    </a>
                    <a href="noticia.php" class="list-group-item list-group-item-action">
                         <h3 class="fs-6"><time>12/12/2012</time> - Título da notícia</h3>
                        <p>Resumo da notícia</p>
                    </a>
                </div>
            </div>
        </div>



<?php 
require_once "inc/rodape.php";
?>

