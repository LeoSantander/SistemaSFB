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
        <li <?php if($viewVar['nameController'] == "UsuarioController") { ?> class="active" <?php } ?> class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Usuários<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="http://<?php echo APP_HOST; ?>/usuario/cadastro">Adicionar Novo Usuário</a></li>
            <li><a href="http://<?php echo APP_HOST; ?>/usuario/consultar">Consultar Usuários</a></li>
          </ul>
        </li>

        <!--Menu Locais-->
        <li <?php if($viewVar['nameController'] == "EstadoController") { ?> class="active" <?php } ?> class="dropdown">
        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Locais<span class="caret"></span></a> 
		        <ul class="dropdown-menu">
		          <li><h5><strong>Estados</strong></h5></li>
				      <li><a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/estado/cadastro">Adicionar Novo Estado</a></li>
				      <li><a class="dropdown-item" href="#">Consultar Estados</a></li>
              
				      <li><h5><strong>Cidades</strong></h5></li>
				      <li><a class="dropdown-item" href="#">Adicionar Nova Cidade</a></li>
				      <li><a class="dropdown-item" href="#">Consultar Cidades</a></li>
              
				      <li><h5><strong>Locais de Trabalho</strong></h5></li>
				      <li><a class="dropdown-item" href="#">Adicionar Novo Local</a></li>
				      <li><a class="dropdown-item" href="#">Consultar Locais de Trabalho</a></li>
		           
		   		  </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><?php echo $Sessao::retornaUsuario()?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="http://<?php echo APP_HOST; ?>/login/">Sair</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>