<script type="text/javascript">
		function trocar(obj){
            if(document.getElementById('sfm_associados').checked){
                if(obj.style.display == "none"){
				    obj.style.display = "block";
                    document.getElementById('formulario2').style.display = "none";
                    document.getElementById('formulario3').style.display = "none";

										document.getElementById("a_data_inicio").required = true;
										document.getElementById("a_data_fim").required = true;
										document.getElementById("p_data_inicio").required = false;
										document.getElementById("p_data_fim").required = false;
										document.getElementById("d_data_inicio").required = false;
										document.getElementById("d_data_fim").required = false;
			    }
            }
            else if(document.getElementById('sfm_local_trabalho').checked){
                if(obj.style.display == "none"){
				    obj.style.display = "block";
                    document.getElementById('formulario1').style.display = "none";
                    document.getElementById('formulario3').style.display = "none";

										document.getElementById("a_data_inicio").required = false;
										document.getElementById("a_data_fim").required = false;
										document.getElementById("p_data_inicio").required = true;
										document.getElementById("p_data_fim").required = true;
										document.getElementById("d_data_inicio").required = false;
										document.getElementById("d_data_fim").required = false;
                }
            }
            else if(document.getElementById('sfm_dependentes').checked){
                if(obj.style.display == "none"){
				    obj.style.display = "block";
                    document.getElementById('formulario1').style.display = "none";
                    document.getElementById('formulario2').style.display = "none";

										document.getElementById("a_data_inicio").required = false;
										document.getElementById("a_data_fim").required = false;
										document.getElementById("p_data_inicio").required = false;
										document.getElementById("p_data_fim").required = false;
										document.getElementById("d_data_inicio").required = true;
										document.getElementById("d_data_fim").required = true;
                }
            }

		}

		function libera() {

				if(document.getElementById('adataAsso').checked){
						document.getElementById("ordData").disabled = false;
				}
				else {
					document.getElementById("ordData").disabled = true;
				}

				if(document.getElementById('a_cargo').checked){
					document.getElementById("ordCargo").disabled = false;
				}
				else {
					document.getElementById("ordCargo").disabled = true;
				}

				if(document.getElementById('p_data').checked){
					document.getElementById("p.data").disabled = false;
				}
				else {
					document.getElementById("p.data").disabled = true;
				}
		}
</script>
<script>
		$(document).on('change', '.a_check', function() {
			var a_conta = $('.a_check:checked').length;
			if(a_conta > 5 && $(this).is(':checked')) {
					alert("Você Selecionou o Número Máximo de Campos(5) para este Relatório!\nDesmarque algum Campo e Selecione Novamente!");
					$(this).prop('checked',false);
			}
		});
		$(document).on('change', '.p_check', function() {
			var p_conta = $('.p_check:checked').length;
			if(p_conta > 5 && $(this).is(':checked')) {
					alert("Você Selecionou o Número Máximo de Campos(5) para este Relatório!\nDesmarque algum Campo e Selecione Novamente!");
					$(this).prop('checked',false);
			}
		});
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
                        <input class="a_check" value="Nome" name="a_NM_Associado" type="checkbox" checked disabled><label>Nome do Associado</label><br>
                        <input class="a_check" value="RG" name="a_RG" type="checkbox"><label>RG</label><br>
                        <input class="a_check" value="CPF" name="a_CPF" type="checkbox"><label>CPF</label><br>
                        <input class="a_check" value="Data Nasc." name="a_DT_Nascimento" type="checkbox"><label>Data Nascimento</label><br>
                        <input class="a_check" value="Dt. Associação" name="a_DT_Associacao" type="checkbox" id="adataAsso" onclick="libera();"><label>Data Associação</label><br>
												<input class="a_check" value="Endereço" name="a_Endereco" type="checkbox"><label>Endereço</label><br>
                    </div>

                    <div class="col-md">
                        <input class="a_check" value="Dependente" name="a_ID_Dependente" type="checkbox"><label>Total Dependentes</label><br>
												<input class="a_check" value="Telefone" name="a_Telefone" type="checkbox"><label>Telefone</label><br>
                        <input class="a_check" value="Celular" name="a_Celular" type="checkbox"><label>Celular</label><br>
                        <input class="a_check" value="Email" name="a_Email" type="checkbox"><label>E-mail</label><br>
												<input class="a_check" value="Situação" name="a_ST_Associado" type="checkbox"><label>Situação</label><br>
                        <input class="a_check" value="N. Registro" name="a_NO_Registro" type="checkbox"><label>Nº Registro</label><br>
                    </div>

                    <div class="col-md">
                        <input class="a_check" value="Posto" name="a_ID_Local_Trabalho" type="checkbox"><label>Local de Trabalho</label><br>
                        <input class="a_check" value="Cargo" name="a_Cargo" type="checkbox" id="a_cargo" onclick="libera();"><label>Cargo</label><br>
												<input class="a_check" value="Salário" name="a_VL_Salario" type="checkbox"><label>Salário</label><br>
                        <input class="a_check" value="Usuário" name="a_ID_Usuario_Inclusao" type="checkbox"><label>Usuário Inclusão</label><br>
                        <input class="a_check" value="Data Inclusão" name="a_DH_Inclusao" type="checkbox"><label>Data Inclusão</label><br>
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
                        <input value="Ativo" type="radio" id="a.ativo" name="a_situacao" checked><label>Ativo</label><br>
                        <input value="Inativo" type="radio" id="a.inativo" name="a_situacao"><label>Inativo</label><br>
                        <input value="Desligado" type="radio" id="a.desligado" name="a_situacao"><label>Desligado</label><br>
												<input value="Todos" type="radio" id="a.todos" name="a_situacao"><label>Todos</label><br>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Data Inicio</label><br>
                        <input value="a.data_inicio" type="date" name="a_data_inicio" class="form-control" id="a_data_inicio" required>
                        <label>Data Final</label><br>
                        <input value="a.data_fim" type="date" name="a_data_fim" class="form-control" id="a_data_fim" required>
                    </div>
										<div class="form-group col-md-1">
										</div>

										<div class="form-group col-md-5">
											<label><b>Ordenar Por</b></label><br>
											<input value="a.NM_Associado" type="radio" id="a.nome" name="a_ordem" checked><label>Nome</label><br>
											<input value="a.DT_Associacao" type="radio" id="ordData" name="a_ordem" disabled><label>Data Associação</label><br>
											<input value="a.Cargo" type="radio" id="ordCargo" name="a_ordem" disabled><label>Cargo</label><br>
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
                        <input class="p_check" value="Nome" name="p_NM_Fantasia" type="checkbox" checked disabled><label>Nome Local</label><br>
												<input class="p_check" value="CNPJ" name="p_CNPJ" type="checkbox"><label>CNPJ</label><br>
                        <input class="p_check" value="Sigla" name="p_CD_Local_Trabalho" type="checkbox"><label>Sigla</label><br>
												<input class="p_check" value="Associados" name="p_Associados" type="checkbox"><label>Total Associados</label><br>
												<input class="p_check" value="Escritório" name="p_Escritorio" type="checkbox"><label>Escritório</label><br>

                    </div>

                    <div class="col-md">
												<input class="p_check" value="Email" name="p_Email" type="checkbox"><label>Email</label><br>
												<input class="p_check" value="Telefone" name="p_Telefone" type="checkbox"><label>Telefone</label><br>
                        <input class="p_check" value="Endereço" name="p_Endereco" type="checkbox"><label>Endereço</label><br>
                        <input class="p_check" value="Usuário" name="p_ID_Usuario_Inclusao" type="checkbox"><label>Usuário Inclusão</label><br>
                        <input class="p_check" value="Data de Inclusão" name="p_DH_Inclusao" type="checkbox" id="p_data" onclick="libera();"><label>Data Inclusão</label><br>
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
                        <input value="p.data_inicio" type="date" name="p_data_inicio" class="form-control" id="p_data_inicio">
                        <label>Data Final</label><br>
                        <input value="p.data_fim" type="date" name="p_data_fim" class="form-control" id="p_data_fim">
                    </div>
										<div class="form-group col-md-1">
										</div>

                    <div class="form-group col-md-8">
											<label><b>Ordenar Por</b></label><br>
											<input value="p.NM_Fantasia" type="radio" id="p.nome" name="p_ordem" checked><label>Nome</label><br>
											<input value="p.DH_Inclusao" type="radio" id="p.data" name="p_ordem" disabled><label>Data</label><br>
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
                <div class="row">
										<h5>Associado</h5>

                    <div class="col-md">
                        <input value="Nome" name="d_NM_Associado" type="checkbox" checked disabled><label>Nome Associado</label><br>
                        <input value="CPF" name="d_CPF" type="checkbox" checked disabled><label>CPF</label><br>
                    </div>

		                <h5>Dependente</h5>
                    <div class="col-md">
                        <input value="Nome Dependente" name="d_NM_Dependente" type="checkbox" checked disabled><label>Nome Dependente</label><br>
                        <input value="Grau" name="d_NM_Grau" type="checkbox" checked><label>Grau de Dependência</label><br>
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
                        <input value="Ativo" type="radio" id="d.ativo" name="d_situacao" checked><label>Ativo</label><br>
                        <input value="Inativo" type="radio" id="d.inativo" name="d_situacao"><label>Inativo</label><br>
                        <input value="Desligado" type="radio" id="d.desligado" name="d_situacao"><label>Desligado</label><br>
												<input value="Todos" type="radio" id="d.todos" name="d_situacao"><label>Todos</label><br>
                    </div>

                    <div class="form-group col-md-3">
                        <label>Data Inicio</label><br>
                        <input value="d.data_inicio" type="date" name="d_data_inicio" id="d_data_inicio" class="form-control">
                        <label>Data Final</label><br>
                        <input value="d.data_fim" type="date" name="d_data_fim" id="d_data_fim" class="form-control">
                    </div>

										<div class="form-group col-md-1">
										</div>

										<div class="form-group col-md-5">
											<label><b>Ordenar Por</b></label><br>
											<p>Este relatório é ordenado pelo <br>Nome do Associado.</p>
										</div>
                </div>
            </div>
        </div><!--FIM DO CARD FILTROS--><br>
    </div><!--Fim do FORMULARIO 3-->

		<table width="100%">
				<tr>
						<td align="right">
							<button type="submit" target="_blank" class="btn btn-success">Gerar PDF</button>
							<a href="http://<?php echo APP_HOST; ?>/home" class="btn btn-outline-primary">Voltar</a>
						</td>
				</tr>
		</table>

    </form>


</div>
