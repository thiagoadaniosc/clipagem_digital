
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<script src="js/plugins/piexif.min.js" type="text/javascript"></script>
<script src="js/plugins/purify.min.js" type="text/javascript"></script>
<script src="js/plugins/sortable.min.js" type="text/javascript"></script>
<script src="js/fileinput.min.js"></script>
<script src="js/locales/pt-BR.js" type="text/javascript"></script>
<script src="themes/explorer-fa/theme.js" type="text/javascript"></script>
<script src="themes/fa/theme.js" type="text/javascript"></script>




<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
    crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>





<script src="js/tagsinput.js"></script>

<?php if ($request_uri == "/editar"): ?>
<script>
 $("#file").fileinput({
    initialPreview: [
        "/uploads/<?= $clipagem['nome'] ?>",
    ],
    initialPreviewAsData: true, // allows you to set a raw markup
    initialPreviewFileType: 'pdf', // image is the default and can be overridden in config below
   // initialPreviewDownloadUrl:' <embed src="/uploads/<?=$clipagem['nome']?>" type="application/pdf"></embed>', // includes the dynamic key tag to be replaced for each config
    initialPreviewConfig: [
        {type: "pdf", caption: "<?= $clipagem['nome']?>", url: "/uploads/<?= $clipagem['nome']?>", key: <?php echo intval($clipagem['ID'])?>, url: null},
        
    ],
    theme: 'fa',
    language: 'pt-BR',
    allowedFileExtensions: ['pdf'],
});
</script>

<?php endif; ?>

<script src="js/script.js"></script>





</body>

</html>