<script type="text/javascript">
		function trocar(obj){
            if(document.getElementById('sfm_associados').checked){
                if(obj.style.display == "none"){
				    obj.style.display = "block";
                    document.getElementById('formulario2').style.display = "none";
                    document.getElementById('formulario3').style.display = "none";
			    }
            }
            else if(document.getElementById('sfm_local_trabalho').checked){
                if(obj.style.display == "none"){
				    obj.style.display = "block";
                    document.getElementById('formulario1').style.display = "none";
                    document.getElementById('formulario3').style.display = "none";
                }
            }
            else if(document.getElementById('sfm_dependentes').checked){
                if(obj.style.display == "none"){
				    obj.style.display = "block";
                    document.getElementById('formulario1').style.display = "none";
                    document.getElementById('formulario2').style.display = "none";
                }
            }

		}
</script>

<div class="container">
    <div class="row">
        <h3>Relatórios<h3>

    </div>
    <hr>
    <form method="post" action="http://<?php echo APP_HOST; ?>/relatorio/imprimir" target="_blank">
    <div class="card">
        <div class="card-header">
            <label>Tipo:</label><br>
        </div>
        <div class="card-body">
            <input onclick="return trocar(formulario1);" type="radio" id="sfm_associados" value="sfm_associados" name="tipo"checked><label>Associados</label><br>
            <input onclick="return trocar(formulario2);" type="radio" id="sfm_local_trabalho" value="sfm_local_trabalho" name="tipo"><label>Postos</label><br>
            <input onclick="return trocar(formulario3);" type="radio" id="sfm_dependentes" value="sfm_dependentes" name="tipo"><label>Associados/ Dependentes</label><br>
        </div>
    </div><br>

    <div id="formulario1" style="display:block">
        <div class="card">
            <div class="card-header">
                Campos
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <input value="a.NM_Associado" name="a_NM_Associado" type="checkbox"><label>Nome do Associado</label><br>
                        <input value="a.RG" name="a_RG" type="checkbox"><label>RG</label><br>
                        <input value="a.CPF" name="a_CPF" type="checkbox"><label>CPF</label><br>
                        <input value="a.DT_Nascimento" name="a_DT_Nascimento" type="checkbox"><label>Data Nascimento</label><br>
                        <input value="a.DT_Associacao" name="a_DT_Associacao" type="checkbox"><label>Data Associação</label><br>
                    </div>

                    <div class="col-md">
                        <input value="a.Telefone" name="a_Telefone" type="checkbox"><label>Telefone</label><br>
                        <input value="a.Celular" name="a_Celular" type="checkbox"><label>Celular</label><br>
                        <input value="a.Email" name="a_Email" type="checkbox"><label>E-mail</label><br>
                        <input value="a.Endereco" name="a_Endereco" type="checkbox"><label>Endereço</label><br>
                        <input value="a.NO_Registro" name="a_NO_Registro" type="checkbox"><label>Nº Registro</label><br>
                    </div>

                    <div class="col-md">
                        <input value="a.ID_Local_Trabalho" name="a_ID_Local_Trabalho" type="checkbox"><label>Local de Trabalho</label><br>
                        <input value="a.Cargo" name="a_Cargo" type="checkbox"><label>Cargo</label><br>
												<input value="a.VL_Salario" name="a_VL_Salario" type="checkbox"><label>Salário</label><br>
                        <input value="a.ST_Associado" name="a_ST_Associado" type="checkbox"><label>Situação</label><br>
                        <input value="a.ID_Usuario_Inclusao" name="a_ID_Usuario_Inclusao" type="checkbox"><label>Usuário Inclusão</label><br>
                        <input value="a.DH_Inclusao" name="a_DH_Inclusao" type="checkbox"><label>Data Inclusão</label><br>
                    </div>
                </div>
            </div>
        </div><!--Fim do CARD CAMPOS--><br>
        <div class="card">
            <div class="card-header">
                Filtros
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label><b>Situação do Associado</b></label><br>
                        <input value="a.ativo" type="radio" id="a.ativo" name="a_situacao" checked><label>Ativo</label><br>
                        <input value="a.inativo" type="radio" id="a.inativo" name="a_situacao"><label>Inativo</label><br>
                        <input value="a.todos" type="radio" id="a.todos" name="a_situacao"><label>Todos</label><br>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Data Inicio</label><br>
                        <input value="a.data_inicio" type="date" name="a_data_inicio" class="form-control">
                        <label>Data Final</label><br>
                        <input value="a.data_fim" type="date" name="a_data_fim" class="form-control">
                    </div>

                    <div class="form-group col-md-6">

                    </div>
                </div>
            </div>
        </div><!--FIM DO CARD FILTROS--><br>

    </div><!--Fim do FORMULARIO 1-->

    <div id="formulario2" style="display:none">
        <div class="card">
            <div class="card-header">
                Campos
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md">
                        <input value="Nome" name="p_NM_Fantasia" type="checkbox" checked><label>Nome Local</label><br>
                        <input value="Sigla" name="p_CD_Local_Trabalho" type="checkbox"><label>Sigla</label><br>
                        <input value="CNPJ" name="p_CNPJ" type="checkbox"><label>CNPJ</label><br>
                        <input value="Email" name="p_Email" type="checkbox"><label>Email</label><br>
                    </div>

                    <div class="col-md">
												<input value="Telefone" name="p_Telefone" type="checkbox"><label>Telefone</label><br>
                        <input value="Endereço" name="p_Endereco" type="checkbox"><label>Endereço</label><br>
                        <input value="Usuário" name="p_ID_Usuario_Inclusao" type="checkbox"><label>Usuário Inclusão</label><br>
                        <input value="Data de Inclusão" name="p_DH_Inclusao" type="checkbox"><label>Data Inclusão</label><br>
                    </div>
                </div>
            </div>
        </div><!--Fim do CARD CAMPOS--><br>
        <div class="card">
            <div class="card-header">
                Filtros
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="form-group col-md-3">
                        <label>Data Inicio</label><br>
                        <input value="p.data_inicio" type="date" name="p_data_inicio" class="form-control"required>
                        <label>Data Final</label><br>
                        <input value="p.data_fim" type="date" name="p_data_fim" class="form-control" required>
                    </div>

                    <div class="form-group col-md-9">

                    </div>
                </div>
            </div>
        </div><!--FIM DO CARD FILTROS--><br>

    </div><!--Fim do FORMULARIO 2-->

    <div id="formulario3" style="display:none">
        <div class="card">
            <div class="card-header">
                Campos
            </div>
            <div class="card-body">
                <h5>Associado</h5>
                <hr>
                <div class="row">
                    <div class="col-md">
                        <input value="d.NM_Associado" name="d_NM_Associado" type="checkbox"><label>Nome Associado</label><br>
                        <input value="d.RG" name="d_RG" type="checkbox"><label>RG</label><br>
                        <input value="d.CPF" name="d_CPF" type="checkbox"><label>CPF</label><br>
                        <input value="d.DT_Nascimento" name="d_DT_Nascimento" type="checkbox"><label>Data Nascimento</label><br>
                        <input value="d.DT_Associacao" name="d_DT_Associacao" type="checkbox"><label>Data Associação</label><br>
                    </div>

                    <div class="col-md">
                        <input value="d.Telefone" name="d_Telefone" type="checkbox"><label>Telefone</label><br>
                        <input value="d.Celular" name="d_Celular" type="checkbox"><label>Celular</label><br>
                        <input value="d.Email" name="d_Email" type="checkbox"><label>E-mail</label><br>
                        <input value="d.Endereco" name="d_Endereco" type="checkbox"><label>Endereço</label><br>
                        <input value="d.NO_Registro" name="d_NO_Registro" type="checkbox"><label>Nº Registro</label><br>

                    </div>

                    <div class="col-md">
                        <input value="d.ID_Local_Trabalho" name="d_ID_Local_Trabalho" type="checkbox"><label>Local de Trabalho</label><br>
                        <input value="d.Cargo" name="d_Cargo" type="checkbox"><label>Cargo</label><br>
												<input value="d.VL_Salario" name="d_VL_Salario" type="checkbox"><label>Salário</label><br>
                        <input value="d.ST_Situacao" name="d_ST_Situacao" type="checkbox"><label>Situação</label><br>
                        <input value="d.ID_Usuario_Inclusao" name="d_ID_Usuario_Inclusao" type="checkbox"><label>Usuário Inclusão</label><br>
                        <input value="d.DH_Inclusao" name="d_DH_Inclusao" type="checkbox"><label>Data Inclusão</label><br>
                    </div>
                </div><br>
                <h5>Dependente</h5>
                <hr>
                <div class="row">
                    <div class="col-md">
                        <input value="d.NM_Dependente" name="d_NM_Dependente" type="checkbox"><label>Nome Dependente</label><br>
                        <input value="d.NM_Grau" name="d_NM_Grau" type="checkbox"><label>Grau de Dependência</label><br>
                    </div>
                </div>
            </div>
        </div><!--FIM DO CARD CAMPOS--><br>

        <div class="card">
            <div class="card-header">
                Filtros
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label><b>Situação do Associado</b></label><br>
                        <input value="d.todos" type="radio" id="d.ativo" name="d_situacao" checked><label>Ativo</label><br>
                        <input value="d.todos" type="radio" id="d.inativo" name="d_situacao"><label>Inativo</label><br>
                        <input value="d.todos" type="radio" id="d.todos" name="d_situacao"><label>Todos</label><br>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Data Inicio</label><br>
                        <input value="d.data_inicio" type="date" name="d_data_inicio" class="form-control">
                        <label>Data Final</label><br>
                        <input value="d.data_fim" type="date" name="d_data_fim" class="form-control">
                    </div>

                    <div class="form-group col-md-6">

                    </div>
                </div>
            </div>
        </div><!--FIM DO CARD FILTROS--><br>
    </div><!--Fim do FORMULARIO 3-->


    <button type="submit" target="_blank" class="btn btn-danger">Gerar PDF</button>
    <a href="http://<?php echo APP_HOST; ?>/relatorio/lista" class="btn btn-success">Gerar Relatório</a>
    </form>


</div>
