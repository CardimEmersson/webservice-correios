<div class="form-tracking">
  <h1 class="title">Webservice Rastreio - Formulário</h1>
  <form action="/webservice-correios/rastreio.php" method="POST" onsubmit="disableButton()">
    <div class="input-container">
      <label for="user">Usuário</label>
      <input type="text" name="user" id="user" placeholder="Digite seu usuário" required />
    </div>


    <div class="input-container">
      <label for="password">Senha</label>
      <input type="password" name="password" id="password" placeholder="Digite sua senha" required />
    </div>

    <div class="input-container">
      <label for="code">Código de rastreio</label>
      <input type="text" name="code" id="code" required placeholder="Ex: AA123456789BR" />
    </div>

    <button id="button-submit" class="button-submit" type="submit">Enviar</button>
  </form>
</div>

<?php 
if(!empty($_REQUEST["objetoRastreio"])) { 
  $obj =$_REQUEST["objetoRastreio"];
        
  if (isset($obj->erro)) {
    echo  "<span>Código Rastreio: <strong>{$obj->numero}</strong></span>";
  }

  // NOTA: Caso objeto rastreado possua apenas 1 evento, 
  // Correios retorna o evento dentro de um Object e não um Array.
  if (is_object($obj->evento)) :
    $tmp = array();
    $tmp[] = $obj->evento;
    $obj->evento = $tmp;
  endif;
?>
<div class="result-tracking">
  <h1 class="title">Encomenda</h1>

  <div class="result-data">
    <span>Código Rastreio: <strong><?php echo $obj->numero; ?></strong></span>
    <span>Sigla: <strong><?php echo $obj->sigla; ?></strong></span>
    <span>Nome: <strong><?php echo $obj->nome; ?></strong></span>
    <span>Categoria: <strong><?php echo $obj->categoria; ?></strong></span>
    <?php 
    foreach ($obj->evento as $ev): ?>
    <span>Tipo: <strong><?php echo $ev->tipo; ?></strong></span>
    <span>Status: <strong><?php echo $ev->status; ?></strong></span>
    <span>Data: <strong><?php echo $ev->data; ?></strong></span>
    <span>Hora: <strong><?php echo $ev->hora; ?></strong></span>
    <span>Descrição: <strong><?php echo $ev->descricao; ?></strong></span>

    <?php 
    if (isset($ev->detalhe)) { ?>
    <span>Detalhe: <strong><?php echo $ev->detalhe; ?></strong></span>
    <?php } ?>

    <span>Local: <strong><?php echo $ev->local; ?></strong></span>
    <span>Código: <strong><?php echo $ev->codigo; ?></strong></span>
    <span>Cidade: <strong><?php echo $ev->cidade; ?></strong></span>
    <span>UF: <strong><?php echo $ev->uf; ?></strong></span>

    <?php 
    if (isset($ev->destino)) : ?>
    <span>Destino (Local): <strong><?php echo $ev->destino->local; ?></strong></span>
    <span>Destino (Código): <strong><?php echo $ev->destino->codigo ?></strong></span>
    <span>Destino (Cidade): <strong><?php echo $ev->destino->cidade ?></strong></span>
    <span>Destino (Bairro): <strong><?php echo $ev->destino->bairro ?></strong></span>
    <span>Destino (UF): <strong><?php echo $ev->destino->uf ?></strong></span>
    <?php 
    endif; ?>
    <hr />
    <?php
    endforeach;
    ?>

  </div>
</div>
<?php } ?>

<script type="text/javascript">
  function disableButton() {
    document.getElementById('button-submit').disabled = true;
  }
</script>