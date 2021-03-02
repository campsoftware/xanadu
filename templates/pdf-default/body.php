<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet">
    <style>
        /*
        family=IBM+Plex+Sans|IBM+Plex+Sans+Condensed|IBM+Plex+Serif|IBM+Plex+Mono&display=swap
        font-family: 'IBM Plex Sans', sans-serif;
        font-family: 'IBM Plex Sans Condensed', sans-serif;
        font-family: 'IBM Plex Serif', serif;
        font-family: 'IBM Plex Mono', monospace;
        */
        body {
            font-family: 'IBM Plex Sans', sans-serif;
            font-size: [ [FONT-SIZE] ];
        }
        h2 {
            padding: 0px;
            margin: 0px;
        }
        /* Page Breaks - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
        section, tr, li {
            -webkit-column-break-inside: avoid !important;
            page-break-inside: avoid !important;
            break-inside: avoid !important;
        }
        .pagebreak {
            page-break-before: always;
        }
        @media print {
            .noprint {
                display: none;
            }
        }
        .theadRepeat {
            display: table-header-group;
        }
        .tfootRepeat {
            display: table-footer-group;
        }
        .floater {
            float: left;
            min-height: 40px;
            margin-left: 20px;
            margin-bottom: 20px;
        }
        /* Tables - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - */
        .tableBorderNone {
            border: 0px;
            border-collapse: collapse;
        }
        .tableBorder {
            border: 1px solid silver;
            border-collapse: collapse;
        }
        .cellLabelBorder {
            border: 1px solid silver;
            padding: 4px;
            vertical-align: top;
            font-weight: bold;
            /* background-color: #cccccc; */
        }
        .cellLabelBorderNone {
            border: 0px;
            padding: 4px;
            vertical-align: top;
            font-weight: bold;
            /* background-color: #cccccc; */
        }
        .cellHeaderBorder {
            border: 1px solid silver;
            padding: 4px;
            vertical-align: bottom;
            font-weight: bold;
            /* background-color: #cccccc; */
        }
        .cellHeaderBorderNone {
            border: 0px;
            padding: 4px;
            vertical-align: bottom;
            font-weight: bold;
            /* background-color: #cccccc; */
        }
        .cellBorderNone {
            border: 0px;
            padding: 4px;
            vertical-align: top;
        }
        .cellBorder {
            border: 1px solid silver;
            padding: 4px;
            vertical-align: top;
        }
        .cellMiddle {
            vertical-align: middle;
        }
        .cellLeft {
            text-align: left;
        }
        .cellRight {
            text-align: right;
        }
        .cellCenter {
            text-align: center;
        }
        .width100 {
            width: 100%;
        }
    </style>
</head>
<body>
[[BODY]]
</body>
</html>