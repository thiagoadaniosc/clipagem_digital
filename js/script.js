$('#file').fileinput({
    theme: 'fa',
    language: 'pt-BR',
    allowedFileExtensions: ['pdf']
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