<?php $this->layout('layout', ['title' => 'Admin']) ?>

<?php $this->start('main_content') ?>
<h2>Administration</h2>
<h3>Articles:</h3>
<a href="<?= $this->url('admin_import') ?>">Importer les articles au format JSON</a>
<?php if (count($articles) > 0): ?>
<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Date</th>
            <th>Auteur</th>
            <th>Contenu</th>
        </tr>
        <tr>
            <th>
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
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($articles as $article): ?>
        <tr>
            <td><a href="<?= $this->url('admin_article', ['id' => $article['id']]) ?>?<?= http_build_query(array_merge($queryStringParameters, ['page' => $currentPage])) ?>"><?= $this->escape($article['title']) ?></a></td>
            <td><?= $this->escape($article['date_add']) ?></td>
            <td><?= $this->escape($article['author']) ?></td>
            <td><?= $this->truncate($article['content'], 150)?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">
                <?php if ($totalPages > 1): ?>
                    <?php if ($currentPage > 1): ?>
                        <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => 1])) ?>"><<</a>
                        <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => $currentPage - 1])) ?>"><</a>
                    <?php else: ?>
                        <span><<</span>
                        <span><</span>
                    <?php endif; ?>
                    <?php for ($i = ($currentPage - 2); $i <= ($currentPage + 2); ++$i): ?>
                        <?php if ($i > 0 && $i < $totalPages + 1): ?>
                            <?php if ($i === $currentPage): ?>
                                <span><?= $i ?></span>
                            <?php else: ?>
                                <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => $i])) ?>"><?= $i ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => $currentPage + 1])) ?>">></a>
                        <a href="?<?= http_build_query(array_merge($queryStringParameters, ['page' => $totalPages])) ?>">>></a>
                    <?php else: ?>
                        <span>></span>
                        <span>>></span>
                    <?php endif; ?>
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
