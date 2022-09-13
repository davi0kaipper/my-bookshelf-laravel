<?php if (! empty($pagination)): ?>
    <nav>
        <ul class="pagination">

            <?php if ($pagination['previous'] !== null): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $pagination['previous'] ?>&size=<?= $pagination['size']; ?>">Anterior</a>
                </li>
            <?php endif; ?>

            <?php foreach ($pagination['pages'] as $page): ?>
                <li class="page-item <?= ($page == $pagination['current']) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page ?>&size=<?= $pagination['size'] ?>"><?= $page; ?></a>
                </li>
            <?php endforeach; ?>

            <?php if ($pagination['next'] !== null): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $pagination['next'] ?>&size=<?= $pagination['size']; ?>">Próxima</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
