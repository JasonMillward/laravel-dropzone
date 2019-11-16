require('./bootstrap');

var dropzone = new Dropzone('#dropzone', {
    url: '#',
    method: 'put',
    autoQueue: false,
    autoProcessQueue: false,
    init: function () {
        this.on('addedfile', function (file) {
            fetch('/s3-url?&name=' + file.name, {
                method: 'get'
            }).then(function (response) {
                return response.json();
            }).then(function (json) {
                dropzone.options.url = json.url;
                file.additionalData = json.additionalData;
                dropzone.processFile(file);
            });
        });

        this.on('sending', function (file, xhr, formData) {
            xhr.timeout = 99999999;
            for (var field in file.additionalData) {
                formData.append(field, file.additionalData[field]);
            }
        });

        this.on('success', function (file) {
            // Let the Laravel application know the file was uploaded successfully
        });
    },
    sending: function (file, xhr) {
        var _send = xhr.send;
        xhr.send = function () {
            _send.call(xhr, file);
        };
    },
});
