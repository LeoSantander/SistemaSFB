<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Dependente</h3>
            <hr>

            <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
            <?php }?>

            <?php if($Sessao::retornaSucesso()){//Retorna mensagem 'Estado cadastrado com sucesso!'?>
                <div class="alert alert-success" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    <?php echo $Sessao::retornaSucesso()?>
                </div>
            <?php }?>

            <form action="http://<?php echo APP_HOST; ?>/dependente/salvar" method="post">
                <div class="form-group">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome Completo" pattern="[A-Za-zÀ-ú ]{0,}"
                           title="Use somente letras. Não use caracteres especiais ou números." value="<?php echo $Sessao::retornaValorFormulario('nome'); ?>"
                           required autofocus>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="rg">RG:</label>
                        <input type="rg" class="form-control" name="rg" placeholder="000000000" maxlength="9" pattern="[0-9]{8}[0-9xX]{1}"
                               title="Digite somente números com 9 digitos" value="<?php echo $Sessao::retornaValorFormulario('rg'); ?>" required >
                    </div>

                    <div class="form-group col-md-6">
                        <label for="cpf">CPF:</label>
                        <input type="cpf" id="cpf" maxlength="14" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}"  class="form-control"
                               placeholder="000.000.000-00" name="cpf" placeholder="" value="<?php echo $Sessao::retornaValorFormulario('cpf'); ?>" required oninvalid="this.setCustomValidity('Este campo deve estar preenchido e atender ao padrão exigido: 000.000.000-00')" onchange="try{setCustomValidity('')}catch(e){}" onkeydown="javascript: fMasc( this, mCPF );">
                    </div>
                </div>

                <div class="form-group">
                    <label for="dataNasc">Data de Nascimento:</label>
                    <input type="date" id="dataNasc" name="dataNasc" class="form-control" value="<?php echo $Sessao::retornaValorFormulario('dataNasc'); ?>" required>
                </div>

                <br><h5>Dados do Associado</h5><hr>

                <div class="form-row">
                    <div class="form-group col-md-7">
                        <label for="associado">Associado:</label>
                        <input list="list-associados" id="associado" name="associado" class="form-control" placeholder="Digite ou Selecione um Associado" required autocomplete="off">
                        <input type="hidden" name="idAssociado" id="idAssociado" value="">
                        <datalist id="list-associados">
                        <select >
                            <?php foreach($viewVar['listarAssociados'] as $associado){?>
                                <option data-id="<?php echo $associado->ID_Associado;?>" value="<?php echo $associado->NM_Associado;?>"></option>
                            <?php } ?>
                        </select>
                        </datalist>
                    </div>

                    <div class="form-group col-md-5">
                        <label for="grau">Grau de Dependência:</label>
                        <select class="form-control" name="grau" value="<?php echo $Sessao::retornaValorFormulario('grau'); ?>" required>
                            <option name="grau" value="">Selecione um Grau</option>
                            <option name="grau" value="Cônjuge">Cônjuge</option>
                            <option name="grau" value="Filho(a)">Filho(a)</option>
                        </select>
                    </div>
                </div>
                <div>
                    <button type="submit" class="btn btn-success">Salvar</button>
                    <a href="http://<?php echo APP_HOST; ?>/home/" class="btn btn-outline-danger">Cancelar</a>
                </div>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>

<script>
$(document).ready(function() {
    $("input#associado").focusout(function(){
        var valor = $('input#associado').val();
        var teste = $('#list-associados [value="' + valor + '"]').data('id');
        document.getElementById("idAssociado").setAttribute('value', teste);
    });
});
</script>
