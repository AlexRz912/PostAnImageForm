<?php

    require __DIR__ . '/tools.php';

    $oldfields = $_SESSION['old'] ?? '';
    unset($_SESSION['old']);

    $errors = $_SESSION['errors'] ?? '';
    unset($_SESSION['errors']);

   ?><form action="processUpload.php" method="POST" enctype="multipart/form-data">
        <div>
            <input type="file" name="image" id="image" value="<?php $oldfields['image'] ?? ''?>">
            <div class="form-error">
            <?php foreach($errors['image'] ?? [] as $error): ?>
            <p>- <?= $error ?></p>
            <?php endforeach; ?>
        </div>
        </div>
        <div>
            <input type="text" name="title" id="title" value="<?php $oldfields['title'] ?? '' ?>">
            <div class="form-error">
            <?php foreach($errors['title'] ?? [] as $error): ?>
            <p>- <?= $error ?></p>
            <?php endforeach; ?>
        </div>
        </div>
        <div>
            <input type="textarea" name="description" id="description" <?php $oldfields['description'] ?? ''?>>
            <div class="form-error">
            <?php foreach($errors['description'] ?? [] as $error): ?>
            <p>- <?= $error ?></p>
            <?php endforeach; ?>
        </div>
        </div>
        <div>
            <button type="submit">Envoyer</button>
        </div>
   </form>

   <!-- <br /><b>Warning</b>:  Illegal string offset 'title' in <b>C:\MAMP\htdocs\PHP-MySQL\file-upload-form\post-and-comment.php</b> on line <b>21</b><br /><br /><b>Notice</b>:  Uninitialized string offset: 0 in <b>C:\MAMP\htdocs\PHP-MySQL\file-upload-form\post-and-comment.php</b> on line <b>21</b><br /> -->