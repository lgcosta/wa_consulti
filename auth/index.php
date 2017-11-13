<?php

require_once("config.inc");
require_once("squid.inc");

$users = $config['installedpackages']['squidusers']['config'];

if (isset($_POST['form-username'])) {
	if (is_array($users)) {
        $achou = false;
		$novo = array();
		foreach ($users as $user) {
			if ($user['username'] == $_POST['form-username']) {
                $achou = true;
				if ($user['password'] != $_POST['form-password0']) {
                    $error = 'Senha atual incorreta, verifique seus dados';
                    $break;
				} else {
					array_push($novo, array(
						'username' => $_POST['form-username'],
                        'password' => $_POST['form-password1'],
                        'description' => $user['description']
					));
				}
			} else {
				array_push($novo, $user);
			}
        }
        if ($achou == false) {
            $error = 'Usuário não encontrado, verifique seus dados';
        }
        if (! isset($error)) {
            $config['installedpackages']['squidusers']['config'] = $novo;
            write_config();
            squid_resync_users();
            $message = 'Senha alterada com sucesso !';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Proxy ::: Alteração de Senha</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

    </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <img src="assets/img/logo1.png" />
                    </div>
                    <div class="row">

                        <?php if (isset($error)) { ?>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="alert alert-danger alert-white rounded" class="alert">
                                <i class="fa fa-exclamation-triangle pull-left"></i>
                                <?php print $error; ?>
                            </div>
                        </div>
                        <?php } ?>

                        <?php if (isset($message)) { ?>
                        <div class="col-sm-6 col-sm-offset-3">
                            <div class="alert alert-success alert-white rounded" class="alert">
                                <i class="fa fa-check pull-left"></i>
                                <?php print $message; ?>
                            </div>
                        </div>
                        <?php } ?>

                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Alteração de Senha</h3>
                            		<p>Preencha com seu nome de usuário, senha atual e nova senha:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-key"></i>
                        		</div>
                            </div>

                            <div class="form-bottom">
			                    <form role="form" action="/auth/index.php" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Usuário</label>
			                        	<input type="text" name="form-username" placeholder="Usuário" class="form-username form-control" id="usuario">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password0">Senha Atual</label>
			                        	<input type="password" name="form-password0" placeholder="Senha Atual" class="form-password form-control" id="senha-atual">
                                    </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password1">Nova Senha</label>
			                        	<input type="password" name="form-password1" placeholder="Nova Senha" class="form-password form-control" id="senha-nova1">
                                    </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password2">Repita Senha</label>
			                        	<input type="password" name="form-password2" placeholder="Repita Senha" class="form-password form-control" id="senha-nova2">
			                        </div>                                                                        
			                        <button type="submit" class="btn">Alterar</button>
			                    </form>
		                    </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
