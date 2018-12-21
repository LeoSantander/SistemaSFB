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
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#202020">
  <a class="navbar-brand" href="http://<?php echo APP_HOST; ?>/home">Sistema SFM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li <?php if($viewVar['nameController'] == "HomeController") { ?> class="nav-item active" <?php } ?>>
        <a class="nav-link" href="http://<?php echo APP_HOST; ?>/home">Inicio <span class="sr-only">(current)</span></a>
      </li>
      <li <?php if($viewVar['nameController'] == "UsuarioController") { ?> class="nav-item active dropdown" <?php } ?> class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuario/cadastro">Adicionar Novo Usuário</a>
          <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuario/consultar">Consultar Usuários</a>
        </div>
      </li>

      <li <?php if($viewVar['nameController'] == "EstadoController") { ?> class="nav-item active dropdown" <?php } ?> class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Locais
        </a>
        <ul class="dropdown-menu">
        <li class="dropdown-submenu">
		        <a class="nav-link-test" tabindex="-1" href="#">Estados<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		             <li><a tabindex="-1" href="http://<?php echo APP_HOST; ?>/estado/cadastro">Adicionar Novo Estado</a></li>
		             <li><a tabindex="-1" href="#">Consultar Estados</a></li>
		          </ul>
		        </li>

		        <li class="dropdown-submenu">
		        <a class="nav-link-test" tabindex="-1" href="#">Cidade<span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a tabindex="-1" href="#">Adicionar Nova Cidade</a></li>
		            <li><a tabindex="-1" href="#">Consultar Cidades</a></li>
		          </ul>
		        </li>
        </li>
    </ul>
    </ul>
  </div>
  <ul class="navbar-nav navbar-right">
      <a class="nav-link" href="http://<?php echo APP_HOST; ?>/usuario/alterar/<?php echo $Sessao::retornaidUsuario()?>"><?php echo $Sessao::retornaUsuario()?> <span class="sr-only">(current)</span></a>
  </ul>
  <ul class="nav navbar-nav navbar-right">
        <a class="nav-link" href="http://<?php echo APP_HOST; ?>/login/">SAIR <span class="sr-only">(current)</span></a>
  </ul>
</nav>

<script>
$(document).ready(function(){
  $('.dropdown-submenu a.nav-link-test').on("click", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });
});
</script>