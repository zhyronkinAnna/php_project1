<h1>Contacts</h1>

<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<form action="/contacts" method="post">
    <div class="mt-3">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" class="form-control">
    </div>

    <div class="mt-3">
        <label for="message">Message: </label>
        <textarea name="message" id="message" class="form-control"></textarea>
    </div>

    <button class="btn btn-primary mt-3" name="action" value="sendEmail">Send</button>

</form>