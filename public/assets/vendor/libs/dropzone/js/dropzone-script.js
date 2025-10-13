Dropzone.autoDiscover = false;
var acceptedFileTypes = "image/*"; //dropzone requires this param be a comma separated list
var fileList = new Array;
var i = 0;
$("#dropzone").dropzone({
    addRemoveLinks: true,
    maxFiles: 10, //change limit as per your requirements
    dictMaxFilesExceeded: "Maximum upload limit reached",
    acceptedFiles: acceptedFileTypes,
    dictInvalidFileType: "upload only JPG/PNG",
    init: function () {

        // Hack: Add the dropzone class to the element
        $(this.element).addClass("dropzone");

        this.on("success", function (file, serverFileName) {
            fileList[i] = {
                "serverFileName": serverFileName,
                "fileName": file.name,
                "fileId": i
            };
            $('.dz-message').show();
            i += 1;
        });
        this.on("removedfile", function (file) {
            var rmvFile = "";
            for (var f = 0; f < fileList.length; f++) {
                if (fileList[f].fileName == file.name) {
                    rmvFile = fileList[f].serverFileName;
                }
            }

            if (rmvFile) {
                $.ajax({
                    url: upload, //your php file path to remove specified image
                    type: "POST",
                    data: {
                        filenamenew: rmvFile,
                        type: 'delete',
                    },
                });
            }
        });

    }
});