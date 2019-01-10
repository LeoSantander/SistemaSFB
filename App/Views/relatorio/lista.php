<div class="container">
    <div class="table table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-light">
                <tr align="center">
                    <th scope="col">Nome Dependente</th>
                    <th scope="col">RG</th>
                    <th scope="col">CPF</th>
                    <th width="15%" scope="col">Nome Associado</th>
                    <th width="10%" scope="col">Grau</th>
                    <th width="15%" scope="col">Data Inclusão</th>
                    <th scope="col">Usuário</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($viewVar['listarDependentes'] as $dependente) {?>
                    <tr>
                        <td><?php echo $dependente->NM_Dependente;?></td>
                        <td align="center"><?php echo $dependente->RG;?></td>
                        <td align="center"><?php echo $dependente->CPF;?></td>
                        <td align="center" class="text-danger">Sem Associados</td>
                        <td align="center"><?php echo $dependente->NM_Grau;?></td>
                        <td align="center"><?php echo $dependente->DH_Inclusao;?></td>
                        <td align="center"><?php echo $dependente->NM_Usuario;?></td>
                    </tr>
                <?php }?>
            </tbody>
        </table>
        
    </div>
    <table width="100%"><tr><td align="right"><a href="http://<?php echo APP_HOST; ?>/relatorio/imprimir" target="_blank" class="btn btn-success">Gerar PDF</a><td><tr></table>
</div>