<?php
// includes/footer_scripts.php
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>

<?php if(isset($additional_js)): ?>
    <?php foreach($additional_js as $js): ?>
        <script src="<?php echo $js; ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>

<?php if(isset($inline_js) && $inline_js): ?>
    <script>
        <?php echo $inline_js; ?>
    </script>
<?php endif; ?>

</body>
</html>