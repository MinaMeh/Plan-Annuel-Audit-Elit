window.onload = function () {
        var fileupload = document.getElementById("FileUpload1");
        var filePath = document.getElementById("spnFilePath");
        var button = document.getElementById("btnFileUpload");
        button.onclick = function () {
            fileupload.click();
        };
        fileupload.onchange = function () {
            filePath.innerHTML = "<b>fichier sélectionné </b>" ;
        };
        var fileupload1 = document.getElementById("FileUpload2");
        var filePath1 = document.getElementById("spnFilePath2");
        var button1 = document.getElementById("btnFileUpload2");
        button1.onclick = function () {
            fileupload1.click();
        };
        fileupload1.onchange = function () {
            filePath1.innerHTML = "<b>fichier sélectionné </b>" ;
        };
    };

