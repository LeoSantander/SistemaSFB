<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Escritório</h3>
            <hr>

            <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php }?>

            <?php if($Sessao::retornaSucesso()){//Retorna mensagem de sucesso?>
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaSucesso(); ?>
                </div>
            <?php }?>

            <form action="http://<?php echo APP_HOST; ?>/escritorio/atualizar" method="post">
                <input type="hidden" name="id" value="<?php echo $viewVar['escritorio']->ID_Escritorio?>">

                <div class="form-row">
                      <div class="form-group col-md-8">
                              <label for="escritorio">Nome do Escritório:</label>
                              <input type="text" class="form-control"  name="escritorio" placeholder="Nome Completo" value="<?php echo $viewVar['escritorio']->NM_Escritorio; ?>"
                                     title="Este campo não pode estar vazio." required autofocus>
                      </div>
                      <div class="form-group col-md-4">
                              <label for="nome">CNPJ:</label>
                              <input type="text"  maxlength="18"  class="form-control"  name="cnpj" placeholder=" "
                                  value="<?php echo $viewVar['escritorio']->CNPJ_Escritorio; ?>"
                                  oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}"  pattern="[0-9]{2}.[0-9]{3}.[0-9]{3}/[0-9]{4}-[0-9]{2}"
                                  onkeydown="javascript: fMasc( this, mCNPJ );">
                      </div>
                  </div>

                  <br>
                  <h5>Endereço:</h5>
                  <hr>
                  <div class="form-row">
                      <div class="form-group col-md-10">
                          <label for="nome">Rua:</label>
                          <input type="text" class="form-control"  name="rua" placeholder=" Rua Nove de Julho" value="<?php echo $viewVar['escritorio']->NM_Rua; ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                              title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                      </div>
                      <div class="form-group col-md-2">
                          <label for="endereco">Numero:</label>
                          <input type="text" class="form-control" maxlength="5" name="endereco" placeholder="000" value="<?php echo $viewVar['escritorio']->NO_Endereco; ?>"
                              pattern="[0-9]+$" onkeydown="javascript: fMasc( this, mNum );" required autofocus>
                      </div>
                  </div>
                  <div class="form-row">
                      <div class="form-group col-md-9">
                          <label for="nome">Bairro:</label>
                          <input type="text" class="form-control" name="bairro" placeholder="Bairro Nova Marilia" value="<?php echo $viewVar['escritorio']->NM_Bairro; ?>" pattern="[A-Za-zÀ-ú ]{0,}"
                                 title="Use somente letras. Não use caracteres especiais ou números." required autofocus>
                      </div>
                      <div class="form-group col-md-3">
                              <label for="cep">CEP:</label>
                              <input type="text" class="form-control" name="cep" maxlength="10" placeholder="00.000-000" value="<?php echo $viewVar['escritorio']->CEP; ?>" pattern= "[0-9]{2}.[0-9]{3}-[0-9]{3}"
                                 title="Preencha de acordo com o que foi solicitado." onkeydown="javascript: fMasc( this, mCEP );" required autofocus>
                          </div>
                  </div>

                      <div class="form-group">
                        <label for="cidade">Cidade:</label>
                          <select class="form-control" name= "cidade" value="" required>
                              <option name= "cidade" value="">Selecione uma Cidade</option>
                          <?php foreach($viewVar['listarCidades'] as $cidades){
                                  if ($cidades->ID_Cidade == $viewVar['escritorio']->ID_Cidade){?>
                                      <option selected name="cidade" value= "<?php echo $cidades->ID_Cidade;?>"><?php echo $cidades->NM_Cidade;?> - <?php echo $cidades->CD_Estado;?></option>
                                  <?php } ?>
                                  <option name="cidade" value= "<?php echo $cidades->ID_Cidade;?>"><?php echo $cidades->NM_Cidade;?> - <?php echo $cidades->CD_Estado;?></option>
                              <?php } ?>
                          </select>
                      </div>

                  <br>
                  <h5>Contato:</h5>
                  <hr>
                  <div class="form-row">
                      <div class="form-group col-md-4">
                              <label for="telefone">Telefone:</label>
                              <input type="telefone" maxlength="14" class="form-control"  name="telefone" placeholder="(14) 3300-3000"
                                  value="<?php echo $viewVar['escritorio']->Telefone; ?>" pattern="\([0-9]{2}\)[0-9]{4,6}-[0-9]{3,4}$"
                                  title="Este campo deve atender ao formato solicitado!"  onkeydown="javascript: fMasc( this, mTel );" required autofocus>
                      </div>

                      <div class="form-group col-md-8">
                              <label for="email">Email:</label>
                              <input type="email" class="form-control"  name="email" placeholder="nome@dominio.com" value="<?php echo $viewVar['escritorio']->Email; ?>"
                                  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="Este campo deve atender ao formato solicitado: nome@dominio.com" required autofocus>
                      </div>
                  </div>
                  <hr>
                      <button type="submit" class="btn btn-success">Salvar</button>
                      <a href="http://<?php echo APP_HOST; ?>/escritorio/consultar" class="btn btn-outline-danger">Voltar</a>

                  </div>
                  </form>
              </div>
              <div class=" col-md-3"></div>
          </div>
      </div>
