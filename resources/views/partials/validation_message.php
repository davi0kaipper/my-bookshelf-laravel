<?php if (count($validation) !== 0) { ?>
    <ul class="alert alert-danger py-2 mt-2" role="alert">
        <?php foreach ($validation as $error) { ?>
            <li class="mx-3"><?= $error; ?></li>
        <?php } ?>
    </ul>
<?php } ?>