<!DOCTYPE html><html>
<head>
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
            font-size: [[FONT-SIZE]];
        }
    </style>
    <script>
        function subst() {
            var vars = {};
            var query_strings_from_url = document.location.search.substring(1).split('&');
            for (var query_string in query_strings_from_url) {
                if (query_strings_from_url.hasOwnProperty(query_string)) {
                    var temp_var = query_strings_from_url[query_string].split('=', 2);
                    vars[temp_var[0]] = decodeURI(temp_var[1]);
                }
            }
            var css_selector_classes = ['page', 'frompage', 'topage', 'webpage', 'section', 'subsection', 'date', 'isodate', 'time', 'title', 'doctitle', 'sitepage', 'sitepages'];
            for (var css_class in css_selector_classes) {
                if (css_selector_classes.hasOwnProperty(css_class)) {
                    var element = document.getElementsByClassName(css_selector_classes[css_class]);
                    for (var j = 0; j < element.length; ++j) {
                        element[j].textContent = vars[css_selector_classes[css_class]];
                    }
                }
            }
        }
    </script>
</head>
<body style="border:0; margin: 0;" onload="subst();">
<table style="width: 100%">
    <tr valign="top">
        <td style="min-width: 33%; text-align: left;">[[LEFT]]</td>
        <td style="text-align: center;">[[CENTER]]</td>
        <td style="min-width: 33%; text-align: right;">[[RIGHT]]</td>
    </tr>
    <tr valign="top">
        <td style="min-width: 33%; text-align: left;">[[LEFT2]]</td>
        <td style="text-align: center;">[[CENTER2]]</td>
        <td style="min-width: 33%; text-align: right;">[[RIGHT2]]</td>
    </tr>
</table>
</body></html>