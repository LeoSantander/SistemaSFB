<?php $Sessao::limpaUsuario();
      $Sessao::limpaTPUsuario();
      $Sessao::limpaidUsuario();
?>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="http://<?php echo APP_HOST; ?>/public/css/estilo.css">
</head>
<body>
    <div id="form-container">
        <div class="panel" id="form-box">
            <form action="http://<?php echo APP_HOST; ?>/usuario/logar" method="post">
                
                <div class="img"align="center" style="width:30%">
                   <img src="http://<?php echo APP_HOST; ?>/public/img/logo.png" style="width:100%">
                </div>

                <h3 class="text-center">Sindicato dos Frentistas de Marília</h3> <br>
                
                <?php if($Sessao::retornaMensagem()){//Retorna mensagem de erro?>
                <div class="alert alert-warning" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>
                    <?php echo $Sessao::retornaMensagem(); ?>
                </div>
                <?php }?>
                
                <div class="form-group">
                    <label class="sr-only" for="login">Usuário</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-user"></span>
                        </div>
                        <input type="text" name="usuario" class="form-control" placeholder="Digite seu Usuário" required>
                    </div>
                </div>
 
                <div class="form-group">
                    <label class="sr-only" for="senha">Senha</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                        </div>
                        <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required>
                    </div>
                </div>
 
                <div class="form-group">
                    <input type="submit" value="Entrar" class="btn btn-success form-control">
                </div>
 
                
            </form>
        </div>
    </div>
</body>
</html>
