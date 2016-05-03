<?php $this->layout('layout', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<h2>Administration</h2>

<div class="row">
    <div class="col-md-4">
        <a href="<?= $this->url('admin_import') ?>" class="btn btn-default">Importer les articles au format JSON</a>
    </div>
    <div class="col-md-8 text-right">
        <?php if (count($articles) > 0): ?>
        <?php $this->insert('admin/_search') ?>
        <?php endif ?>
    </div>
</div>

<?php if (count($articles) > 0): ?>
<h3>Articles:</h3>
<table class="table table-bordered table-condensed table-striped">
    <thead>
        <tr>
        </tr>
        <tr>
            <th>
                Titre
                <?php if (isset($queryStringParameters['order']) && $queryStringParameters['order'] == 'title' && isset($queryStringParameters['sort']) && $queryStringParameters['sort'] == 'ASC'): ?>
                <span>▲</span>
                <?php else: ?>
                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['order' => 'title', 'sort' => 'ASC'])) ?>">▲</a>
                <?php endif; ?>
                <?php if (isset($queryStringParameters['order']) && $queryStringParameters['order'] == 'title' && isset($queryStringParameters['sort']) && $queryStringParameters['sort'] == 'DESC'): ?>
                <span>▼</span>
                <?php else: ?>
                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['order' => 'title', 'sort' => 'DESC'])) ?>">▼</a>
                <?php endif; ?>
            </th>
            <th>
                Date
                <?php if (isset($queryStringParameters['order']) && $queryStringParameters['order'] == 'date_add' && isset($queryStringParameters['sort']) && $queryStringParameters['sort'] == 'ASC'): ?>
                <span>▲</span>
                <?php else: ?>
                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['order' => 'date_add', 'sort' => 'ASC'])) ?>">▲</a>
                <?php endif; ?>
                <?php if (isset($queryStringParameters['order']) && $queryStringParameters['order'] == 'date_add' && isset($queryStringParameters['sort']) && $queryStringParameters['sort'] == 'DESC'): ?>
                <span>▼</span>
                <?php else: ?>
                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['order' => 'date_add', 'sort' => 'DESC'])) ?>">▼</a>
                <?php endif; ?>
            </th>
            <th>
                Auteur
                <?php if (isset($queryStringParameters['order']) && $queryStringParameters['order'] == 'author' && isset($queryStringParameters['sort']) && $queryStringParameters['sort'] == 'ASC'): ?>
                <span>▲</span>
                <?php else: ?>
                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['order' => 'author', 'sort' => 'ASC'])) ?>">▲</a>
                <?php endif; ?>
                <?php if (isset($queryStringParameters['order']) && $queryStringParameters['order'] == 'author' && isset($queryStringParameters['sort']) && $queryStringParameters['sort'] == 'DESC'): ?>
                <span>▼</span>
                <?php else: ?>
                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['order' => 'author', 'sort' => 'DESC'])) ?>">▼</a>
                <?php endif; ?>
            </th>
            <th>Contenu</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
        <tr>
            <td>
                <a href="<?= $this->url('admin_article', ['id' => $article['id']]) ?>?<?= http_build_query(array_merge($queryStringParameters, ['page' => $currentPage])) ?>">
                    <?= $this->escape($article['title']) ?>
                </a>
            </td>
            <td><?= $this->escape($article['date_add']) ?></td>
            <td><?= $this->escape($article['author']) ?></td>
            <td><?= $this->truncate($article['content'], 150)?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">
                <?php if ($totalPages > 1): ?>
                    <nav>
                        <ul class="pagination">
                            <li class="<?= $currentPage < 2 ? 'disabled' : null ?>">
                                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => 1])) ?>">&lt;&lt;</a>
                            </li>
                            <li class="<?= $currentPage < 2 ? 'disabled' : null ?>">
                                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => ((($currentPage - 1) > 0) ? $currentPage - 1 : 1)])) ?>">&lt;</a>
                            </li>
                            <?php for ($i = ($currentPage - 2); $i <= ($currentPage + 2); ++$i): ?>
                                <?php if ($i > 0 && $i < $totalPages + 1): ?>
                                    <li class="<?= $i === $currentPage ? 'active' : null ?>">
                                        <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => $i])) ?>"><?= $i ?></a>
                                    </li>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <li class="<?= $currentPage > ($totalPages - 1) ? 'disabled' : null ?>">
                                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => ((($currentPage + 1) <= $totalPages) ? $currentPage + 1 : $totalPages)])) ?>">&gt;</a>
                            </li>
                            <li class="<?= $currentPage > ($totalPages - 1) ? 'disabled' : null ?>">
                                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => $totalPages])) ?>">&gt;&gt;</a>
                            </li>
                        </ul>
                    </nav>
                <?php endif; ?>
            </td>
        </tr>
    </tfoot>
</table>
<?php else: ?>
<div class="alert alert-info">
    <ul>
        <li>Aucun article enregistré.</li>
    </ul>
</div>
<?php endif; ?>
<?php $this->stop('main_content') ?>
