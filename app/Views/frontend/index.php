<?php $this->layout('layout', ['title' => 'Accueil']) ?>

<?php $this->start('main_content') ?>
    <h2>Bienvenue !</h2>
    <div class="flexslider">
        <ul class="slides">
            <li>
                <img src="http://lorempixel.com/600/150/cats/fun" />
            </li>
            <li>
                <img src="http://lorempixel.com/600/150/cats/dogs" />
            </li>
            <li>
                <img src="http://lorempixel.com/600/150/" />
            </li>
        </ul>
    </div>
<?php $this->stop('main_content') ?>

<?php $this->start('inline_scripts') ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/jquery.flexslider.min.js"></script>
<script>
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide"
        });
    });
</script>
<?php $this->stop('inline_scripts') ?>

<?php $this->start('head_styles') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">
<?php $this->stop('head_styles') ?>