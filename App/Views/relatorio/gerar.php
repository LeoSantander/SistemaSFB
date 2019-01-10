<script type="text/javascript">
		function trocar(obj){
            if(document.getElementById('sit1').checked){
                if(obj.style.display == "none"){
				    obj.style.display = "block";
                    document.getElementById('formulario2').style.display = "none";
                    document.getElementById('formulario3').style.display = "none";
			    }
            }
            else if(document.getElementById('sit2').checked){
                if(obj.style.display == "none"){
				    obj.style.display = "block";
                    document.getElementById('formulario1').style.display = "none";
                    document.getElementById('formulario3').style.display = "none";
                }
            }
            else if(document.getElementById('sit3').checked){
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
    <div class="card">
        <div class="card-header">
            <label>Tipo:</label><br>
        </div>
        <div class="card-body">
            <input onclick="return trocar(formulario1);" type="radio" id="sit1" name="situacao"checked><label>Associados</label><br>
            <input onclick="return trocar(formulario2);" type="radio" id="sit2" name="situacao"><label>Local de Trabalho</label><br>
            <input onclick="return trocar(formulario3);" type="radio" id="sit3" name="situacao"><label>Associados/ Dependentes</label><br>
        </div>
    </div><br>

    <div class="card">
        <div class="card-header">
            Campos
        </div>
        <div class="card-body">
        <div id="formulario1" style="display:block">
            <form >
                <div class="row">
                    <div class="col-md">
                        <input type="checkbox"><label>Nome do Associado</label><br>
                        <input type="checkbox"><label>RG</label><br>
                        <input type="checkbox"><label>CPF</label><br>
                        <input type="checkbox"><label>Data Nascimento</label><br>
                        <input type="checkbox"><label>Data Associação</label><br>                      
                    </div>

                    <div class="col-md">
                        <input type="checkbox"><label>Telefone</label><br>
                        <input type="checkbox"><label>Celular</label><br>
                        <input type="checkbox"><label>E-mail</label><br>
                        <input type="checkbox"><label>Endereço</label><br>
                        <input type="checkbox"><label>Nº Registro</label><br>
                    </div>

                    <div class="col-md">
                        <input type="checkbox"><label>Local de Trabalho</label><br>
                        <input type="checkbox"><label>Cargo</label><br>
                        <input type="checkbox"><label>Situação</label><br>
                        <input type="checkbox"><label>Usuário Inclusão</label><br>
                        <input type="checkbox"><label>Data Inclusão</label><br>
                    </div>
                </div>
            </form>
        </div>

        <div id="formulario2" style="display:none">
            <form >
                <div class="row">
                    <div class="col-md">
                        <input type="checkbox"><label>Nome Local</label><br>
                        <input type="checkbox"><label>Sigla</label><br>
                        <input type="checkbox"><label>CNPJ</label><br>
                        <input type="checkbox"><label>Email</label><br>
                        <input type="checkbox"><label>Telefone</label><br>
                    </div>

                    <div class="col-md">
                        <input type="checkbox"><label>Endereço</label><br>
                        <input type="checkbox"><label>Situação</label><br>
                        <input type="checkbox"><label>Usuário Inclusão</label><br>
                        <input type="checkbox"><label>Data Inclusão</label><br>
                    </div>
                </div>
            </form>
        </div>

        <div id="formulario3" style="display:none">
            <form >
                <h5>Associado</h5>
                <hr>
                <div class="row">
                    <div class="col-md">
                        <input type="checkbox"><label>Nome Associado</label><br>
                        <input type="checkbox"><label>RG</label><br>
                        <input type="checkbox"><label>CPF</label><br>
                        <input type="checkbox"><label>Data Nascimento</label><br>
                        <input type="checkbox"><label>Data Associação</label><br>
                    </div>

                    <div class="col-md">
                        <input type="checkbox"><label>Telefone</label><br>
                        <input type="checkbox"><label>Celular</label><br>
                        <input type="checkbox"><label>E-mail</label><br>
                        <input type="checkbox"><label>Endereço</label><br>
                        <input type="checkbox"><label>Nº Registro</label><br>
                        
                    </div>

                    <div class="col-md">
                        <input type="checkbox"><label>Local de Trabalho</label><br>
                        <input type="checkbox"><label>Cargo</label><br>
                        <input type="checkbox"><label>Situação</label><br>
                        <input type="checkbox"><label>Usuário Inclusão</label><br>
                        <input type="checkbox"><label>Data Inclusão</label><br>                        
                    </div> 
                </div><br>
                <h5>Dependente</h5>
                <hr>
                <div class="row">
                    <div class="col-md">
                        <input type="checkbox"><label>Nome Dependente</label><br>
                        <input type="checkbox"><label>Grau de Dependência</label><br>  
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div><br>

    <div class="card">
        <div class="card-header">
            Filtros
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-md-3">
                    <label><b>Situação do Associado</b></label><br>
                    <input type="radio" id="sit" name="situacao"><label>Ativo</label><br>
                    <input type="radio" id="sit" name="situacao"><label>Inativo</label><br>
                </div>

                <div class="form-group col-md-3">
                    <label>Data Inicio</label><br>
                    <input type="date" class="form-control">
                    <label>Data Final</label><br>
                    <input type="date" class="form-control">
                </div>

                <div class="form-group col-md-6">
                    
                </div>
            </div>
        </div>
    </div><br>
    <a href="http://<?php echo APP_HOST; ?>/relatorio/lista" class="btn btn-success">Gerar Relatório</a>
</div>
