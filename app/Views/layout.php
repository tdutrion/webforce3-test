<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $this->e($title) ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $this->assetUrl('css/style.css') ?>">
    <?= $this->section('head_styles') ?>
    <?= $this->section('head_scripts') ?>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">W :: Test</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li><a href="<?= $this->url('frontend_index') ?>">Accueil</a></li>
                    <li><a href="<?= $this->url('admin_index') ?>">Administration</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <header class="jumbotron">
            <h1>W :: <?= $this->e($title) ?></h1>
        </header>

        <section>
            <?= $this->section('main_content') ?>
        </section>

        <footer>
            Copyright © 2016 Thomas Dutrion
        </footer>
    </div>
    <?= $this->section('inline_scripts') ?>
    </body>
</html>