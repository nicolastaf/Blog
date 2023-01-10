tinymce.init({
    selector: 'textarea',
    height: 400,
    menubar: false,
    convert_urls: false,
    remove_trailing_brs: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste imagetools',

    ],
    toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
    content_css: [
        'https://fonts.googleapis.com/css?family=Lato:200,200i,300,300i,400,400i',
        'https://www.tinymce.com/css/codepen.min.css']
});