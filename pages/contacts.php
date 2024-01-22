<h1>Contacts</h1>

<?php Message::show(); ?>

<form action="/contacts" method="post">
    <div class="mt-3">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" class="form-control" value="<?= OldInputs::get('email') ?>">
    </div>

    <div class="mt-3">
        <label for="message">Message: </label>
        <textarea name="message" id="message" class="form-control"><?= OldInputs::get('message') ?></textarea>
    </div>

    <button class="btn btn-primary mt-3" name="action" value="sendEmail">Send</button>

</form>

