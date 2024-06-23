<?php
declare(strict_types=1);
?>
<dialog id="modal-window">
    <?= $this->fetch('content') ?>
</dialog>
<script type="text/javascript">
(function() {
    const modal = document.querySelector('#modal-window');
    modal.showModal();
    modal
        .querySelector('[modal-close="1"]')
        .addEventListener('click', function (event) {
            event.preventDefault();
            modal.close();
        }, false);
}());
</script>
