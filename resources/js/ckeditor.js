document.addEventListener("DOMContentLoaded", function () {
    const allEditor = document.querySelectorAll(".editor");
    var editorConfig = {
        items: [
            'undo', 'redo',
            '|', 'heading',
            '|', 'bold', 'italic',
            '|', 'bulletedList', 'numberedList', 'outdent', 'indent'
        ],
        shouldNotGroupWhenFull: false,
    };

    for (i = 0; i < allEditor.length; i++) {
        ClassicEditor.create(allEditor[i],{
            toolbar: editorConfig
        }).catch((error) => {
            console.error(error);
        });
    }
});
