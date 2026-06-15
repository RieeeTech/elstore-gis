<?php $pager->setSurroundCount(2) ?>

<nav aria-label="Page navigation">
    <ul class="pagination">
    <?php if ($pager->hasPreviousPage()) : ?>
        <li>
            <a href="<?= $pager->getPreviousPage() ?>" aria-label="Previous">
                <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
            </a>
        </li>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <li <?= $link['active'] ? 'class="active"' : '' ?>>
            <a href="<?= $link['uri'] ?>">
                <?= $link['title'] ?>
            </a>
        </li>
    <?php endforeach ?>

    <?php if ($pager->hasNextPage()) : ?>
        <li>
            <a href="<?= $pager->getNextPage() ?>" aria-label="Next">
                <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
            </a>
        </li>
    <?php endif ?>
    </ul>
</nav>
