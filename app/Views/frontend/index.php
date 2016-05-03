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
    <div id="articles">
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
    let app = {
        page: 0,
        init: function() {
            this.fetch();
        },
        fetch: function() {
            let pageNumber = this.page + 1;
            $.getJSON('<?= $this->url('api_collection') ?>?page=' + pageNumber, function(data) {
                $('#articles button#more').addClass('disabled');
                data.forEach(function(item){
                    let article = $('<article/>');
                    $('<h2/>', { text: item.title }).appendTo(article);
                    $('<aside/>', { text: 'Par ' + item.author + ', le ' + item.date_add }).appendTo(article);
                    $('<div/>', { text: item.content }).appendTo(article);

                    article.appendTo('#articles');
                    $('#articles button#more').removeClass('disabled');
                });
                $('#more').remove();
                $('<button/>', { class: "btn btn-default", id: "more", text: "Plus d'articles" }).appendTo('#articles');
                app.page++;
            }).fail(function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                console.log(textStatus);
                console.log(errorThrown);
                if (jqXHR.responseJSON.type == "InvalidArgumentException") {
                    $('#more').remove();
                    $('<div/>', { class: "alert alert-info", text: "Il n'y a pas plus d'articles pour le moment." }).appendTo('#articles');
                }
            });
        }
    };
    $(function() {
        app.init();
        $('#articles').on('click', '#more', function() {
            app.fetch();
        });
    });
</script>
<?php $this->stop('inline_scripts') ?>

<?php $this->start('head_styles') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flexslider/2.6.0/flexslider.min.css">
<?php $this->stop('head_styles') ?>