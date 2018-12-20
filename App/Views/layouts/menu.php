<style>
.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
</style>

<nav class="navbar navbar-inverse">
<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>/home">Sistema SFM</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
   
   
   
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($viewVar['nameController'] == "HomeController") { ?> class="active" <?php } ?>>
            <a href="http://<?php echo APP_HOST; ?>/home">Inicio <span class="sr-only">(current)</span></a></li>
        
        <!--Menu Usuários | Só vai aparecer se TPUsuário Logado for = Administrador -->
        <?php if ($Sessao::retornaTPUsuario() == 'Administrador'){?>
        <li <?php if($viewVar['nameController'] == "UsuarioController") { ?> class="active" <?php } ?> class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="http://<?php echo APP_HOST; ?>/usuario/cadastro">Adicionar Novo Usuário</a></li>
            <li><a href="http://<?php echo APP_HOST; ?>/usuario/consultar">Consultar Usuários</a></li>
          </ul>
        </li>
    <?php } ?>

        <!--Menu Locais-->
        <li <?php if($viewVar['nameController'] == "EstadoController") { ?> class="active" <?php } ?> class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Locais<span class="caret"></span></a>
          <ul class="dropdown-menu">
		        
            <li class="dropdown-submenu">
		        <a class="test" tabindex="-1" href="#">Estados<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		             <li><a tabindex="-1" href="http://<?php echo APP_HOST; ?>/estado/cadastro">Adicionar Novo Estado</a></li>
		             <li><a tabindex="-1" href="#">Consultar Estados</a></li>
		          </ul>
		        </li>

		        <li class="dropdown-submenu">
		        <a class="test" tabindex="-1" href="#">Cidade<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a tabindex="-1" href="#">Adicionar Nova Cidade</a></li>
		            <li><a tabindex="-1" href="#">Consultar Cidades</a></li>
		          </ul>
		        </li>

		      </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://<?php echo APP_HOST; ?>/usuario/alterar/<?php echo $Sessao::retornaidUsuario()?>"><?php echo $Sessao::retornaUsuario()?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://<?php echo APP_HOST; ?>/login/">Sair</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

<script>
$(document).ready(function(){
  $('.dropdown-submenu a.test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>