
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
<?php $fileExtension = pathinfo($clipagem['nome'], PATHINFO_EXTENSION); ?>
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

$("#file_audio").fileinput({
    initialPreview: [
        "/uploads/<?= $clipagem['nome'] ?>",
    ],
    initialPreviewAsData: true, // allows you to set a raw markup
    initialPreviewFileType: 'audio', // image is the default and can be overridden in config below
   // initialPreviewDownloadUrl:' <embed src="/uploads/<?=$clipagem['nome']?>" type="application/pdf"></embed>', // includes the dynamic key tag to be replaced for each config
    initialPreviewConfig: [
        {type: "audio", caption: "<?= $clipagem['nome']?>", url: "/uploads/<?= $clipagem['nome']?>", key: <?php echo intval($clipagem['ID'])?>, filetype:'audio/<?= $fileExtension?>'},
        
    ],
    theme: 'fa',
    language: 'pt-BR',
    allowedFileExtensions: ['mp3', 'wav', 'flac', 'aac'],
});

$("#file_video").fileinput({
    initialPreview: [
        "/uploads/<?= $clipagem['nome'] ?>",
    ],
    initialPreviewAsData: true, // allows you to set a raw markup
    initialPreviewFileType: 'video', // image is the default and can be overridden in config below
   // initialPreviewDownloadUrl:' <embed src="/uploads/<?=$clipagem['nome']?>" type="application/pdf"></embed>', // includes the dynamic key tag to be replaced for each config
    initialPreviewConfig: [
        {type: "video", caption: "<?= $clipagem['nome']?>", url: "/uploads/<?= $clipagem['nome']?>", key: <?php echo intval($clipagem['ID'])?>, filetype:'video/<?= $fileExtension?>'},
        
    ],
    theme: 'fa',
    language: 'pt-BR',
    allowedFileExtensions: ['mp4', 'avi', 'mpg', 'flv', 'mov'],
});
</script>

<?php endif; ?>

<script src="js/script.js?version=<?php global $version; echo $version;?>"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-migrate/3.0.1/jquery-migrate.min.js"></script>
 <script src="http://code.jquery.com/jquery-migrate-3.0.0.js"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
<script type="text/javascript">
$(document).ready(function($) {
  $('.counter').counterUp({
      delay: 20,
      time: 1000
  });
});
</script>





</body>

</html>