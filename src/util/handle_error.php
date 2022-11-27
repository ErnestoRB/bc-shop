<?php if (!$isError && $message) {
    echo '<div class="alert alert-success">' . $message . '</div>';
} ?>
<?php if ($isError) {
    echo '<div class="alert alert-danger">' . $message . '</div>';
} ?>