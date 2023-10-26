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
        



<?php 
require_once "inc/todas.php";
require_once "inc/rodape.php";
?>

