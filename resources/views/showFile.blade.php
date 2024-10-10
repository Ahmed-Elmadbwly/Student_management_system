<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
</head>
<body >
@dd(asset($file))
<iframe data="{{asset($file)}}" width=”100%” height=”100%”>

    This browser does not support PDFs. Please download the PDF to view it: Download PDF

</iframe>
</body>
</html>
