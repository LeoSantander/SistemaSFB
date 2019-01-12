<?php if ($Sessao::retornaTPUsuario() == 'Financeiro'){?>
<!--Interface para Financeiro --> 
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

      <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cobranças</a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                
                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Boletos</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item">Ainda não disponível</a>
                  </div>
                </li>

                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Recibos</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Adicionar Novo Recibo</a>
                    <a class="dropdown-item" href="#">Consultar Recibos</a>
                  </div>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Empresas</a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                
                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Postos</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/localTrabalho/cadastro">Adicionar Novo Posto</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/localTrabalho/consultar">Consultar Postos</a>
                  </div>
                </li>

                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Escritórios de Contabilidade</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Adicionar Nova Cidade</a>
                    <a class="dropdown-item" href="#">Consultar Cidades</a>
                  </div>
                </li>
            </ul>
        </li>
        <li <?php if($viewVar['nameController'] == "UsuarioController") { ?> class="nav-item active dropdown" <?php } ?> class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Convênios
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
           <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuario/cadastro">Adicionar Novo Convênio</a>
            <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuario/consultar">Consultar Convênios</a>
          </div>
        </li>
        
        <li <?php if($viewVar['nameController'] == "RelatorioController") { ?> class="nav-item active" <?php } ?>>
          <a class="nav-link" href="http://<?php echo APP_HOST; ?>/relatorio/gerar">Relatórios <span class="sr-only">(current)</span></a>
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

<?php }else{ ?>
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
      <!--Menu Usuários | Só vai aparecer se TPUsuário Logado for = Administrador --> 
      <?php if ($Sessao::retornaTPUsuario() == 'Administrador'){?>
      <li <?php if($viewVar['nameController'] == "UsuarioController") { ?> class="nav-item active dropdown" <?php } ?> class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuários
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuario/cadastro">Adicionar Novo Usuário</a>
          <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/usuario/consultar">Consultar Usuários</a>
        </div>
      </li>
      <?php } ?>

      <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Localidade</a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                
                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Estados</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/estado/cadastro">Adicionar Novo Estado</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/estado/consultar">Consultar Estado</a>
                  </div>
                </li>

                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Cidades</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/cidade/cadastro">Adicionar Nova Cidade</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST;?>/cidade/consultar">Consultar Cidades</a>
                  </div>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Empresas</a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                                
                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Postos</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/localTrabalho/cadastro">Adicionar Novo Posto</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/localTrabalho/consultar">Consultar Postos</a>
                  </div>
                </li>

                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Escritórios de Contabilidade</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Adicionar Nova Cidade</a>
                    <a class="dropdown-item" href="#">Consultar Cidades</a>
                  </div>
                </li>
            </ul>
        </li>

        <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Associados</a>
            <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Convênios</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">Adicionar Novo Convênio</a>
                    <a class="dropdown-item" href="#">Consultar Convênios</a>
                  </div>
                </li>
                
                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Associados</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/associado/cadastro">Adicionar Novo Associado</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/associado/consultar">Consultar Associados</a>
                  </div>
                </li> 

                <li class="dropdown-submenu">
                  <a  class="dropdown-item" tabindex="-1" href="#">Dependentes</a>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/dependente/cadastro">Adicionar Novo Dependente</a>
                    <a class="dropdown-item" href="http://<?php echo APP_HOST; ?>/dependente/consultar">Consultar Dependentes</a>
                  </div>
                </li>
            </ul>
        </li>
        <li <?php if($viewVar['nameController'] == "RelatorioController") { ?> class="nav-item active" <?php } ?>>
          <a class="nav-link" href="http://<?php echo APP_HOST; ?>/relatorio/gerar">Relatório <span class="sr-only">(current)</span></a>
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
      <?php };?>