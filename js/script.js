$('#file').fileinput({
    theme: 'fa',
    language: 'pt-BR',
    allowedFileExtensions: ['pdf'],
    maxFileSize: 600000,
});

$('#file_join').fileinput({
    theme: 'fa',
    language: 'pt-BR',
    allowedFileExtensions: ['pdf'],
    maxFileSize: 60000,
    // dropZoneEnabled: true,
     minFileCount: 0,
    // maxFileCount: 10,
    showUpload: false,
    uploadUrl : '/arquivos/upload',
    showRemove: true
});

$('#file_video').fileinput({
    theme: 'fa',
    language: 'pt-BR',
    allowedFileExtensions: ['mp4', 'avi', 'mpg', 'flv', 'mov'],
    maxFileSize: 60000,

});

$('#file_audio').fileinput({
    theme: 'fa',
    language: 'pt-BR',
    allowedFileExtensions: ['mp3', 'wav', 'flac', 'aac'],
    maxFileSize: 60000,
});

function showSubmit() {
    var show = document.getElementById('show');
    var link = document.getElementById('show-link');

    console.log(link.getAttribute('data-link'));
    
    if (link.getAttribute('data-link') == '' || link.getAttribute('data-link') == null) {
        window.location = '/clipagens' +  '?show=' + show.value;
    } else {
        window.location = '/clipagens' +  '?show=' + show.value + '&' + link.getAttribute('data-link');
    }
}