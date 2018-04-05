<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="css/tagsinput.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
    <link rel="stylesheet" href="css/fileinput.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" media="all" rel="stylesheet"
        type="text/css" />
    <link href="themes/explorer-fa/theme.min.css" media="all" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="css/style.css">

    <title>Clipagem Digital - CMSJ</title>

</head>

<body>

    <div class="row" style="margin:0px; padding: 0px;">
        <div class="col-lg-2 float-left bg-dark">
            <a href="/">
                <img src="img/sao-jose-logo.png" class="img-fluid" style="padding: 5px;">
            </a>
        </div>

        <header class="navbar justify-content-center col-lg-8 navbar-dark bg-dark">
            <a class="navbar-brand" href="/">Clipagem Digital</a>
        </header>

        <div class="navbar justify-content-center col-lg-2 bg-dark">
        <?php if(isset($_SESSION['login']) && $_SESSION['login'] == true): ?>
            <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle col-lg-12 rounded-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?= $_SESSION['nome'] ?>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/logon"><i class="fa fa-sign-out"></i> Sair</a>
            </div>
            </div>
        <?php endif;?>
       
        </div>
    