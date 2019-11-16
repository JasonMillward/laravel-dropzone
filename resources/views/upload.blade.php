<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dropzone Upload</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    </head>
    <body>
        <form action="#" class="dropzone" id="dropzone">
            <div class="dz-default dz-message">
                <span>
                    <i class="material-icons">cloud_upload</i>
                    Drop files here or click to upload.
                </span>
            </div>
        </form>

        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
