<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Loading...</title>
    <meta name="referrer" content="no-referrer">

    <!-- Icons -->
    <link rel='shortcut icon' href='/images/favicon.ico' type='image/x-icon'/>
    <link rel='apple-touch-icon' href='/images/apple-touch-icon.png'/>
    <link rel='apple-touch-icon' sizes='57x57' href='/images/apple-touch-icon-57x57.png'/>
    <link rel='apple-touch-icon' sizes='72x72' href='/images/apple-touch-icon-72x72.png'/>
    <link rel='apple-touch-icon' sizes='76x76' href='/images/apple-touch-icon-76x76.png'/>
    <link rel='apple-touch-icon' sizes='114x114' href='/images/apple-touch-icon-114x114.png'/>
    <link rel='apple-touch-icon' sizes='120x120' href='/images/apple-touch-icon-120x120.png'/>
    <link rel='apple-touch-icon' sizes='144x144' href='/images/apple-touch-icon-144x144.png'/>
    <link rel='apple-touch-icon' sizes='152x152' href='/images/apple-touch-icon-152x152.png'/>
    <link rel='apple-touch-icon' sizes='180x180' href='/images/apple-touch-icon-180x180.png'/>

    <!-- Bootstrap core CSS -->
    <link href="/include/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="/include/bootstrap/theme/darkly/bootstrap.min.css" rel="stylesheet" media="(prefers-color-scheme: dark)">

    <!-- Bootstrap JavaScript -->
    <script src="/include/jquery/3.3.1/jquery.min.js"></script>
    <script src="/include/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

    <!-- FontAwesome https://fontawesome.com/icons -->
    <link href='/include/fontawesome/pro_5.12.1/css/all.min.css' rel='stylesheet' type='text/css'>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'IBM Plex Sans', sans-serif;
        }
    </style>

</head>
<body>

<div class="text-center p-5 m-5">
    <div class="spinner-border" style="width: 2rem; height: 2rem;" role="status">
        <span class="sr-only">Loading... </span>
    </div>
    <br /><?= htmlspecialchars( $_GET["label"], ENT_QUOTES, 'UTF-8' ); ?>
</div>

</body>
</html>