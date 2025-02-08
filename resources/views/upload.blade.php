<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
</head>
<body>
    <h1>Upload File</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
        <p>Uploaded File: <a href="{{ session('file_url') }}" target="_blank">{{ session('file_url') }}</a></p>
    @endif

    <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="file">Choose file:</label>
            <input type="file" name="file" id="file" required>
        </div>
        <div>
            <button type="submit">Upload</button>
        </div>
    </form>
</body>
</html>