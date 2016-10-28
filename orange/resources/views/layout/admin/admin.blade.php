    <!DOCTYPE html>
    <!-- saved from url=(0050)http://coderthemes.com/ubold_2.1/menu_2/index.html -->
    <html class=" js flexbox flexboxlegacy canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="http://coderthemes.com/ubold_2.1/menu_2/assets/images/favicon_1.ico">

    <title>HRM | @yield('title')</title>

    <!--Morris Chart CSS -->
    <link rel="stylesheet" href="css/morris.css">

    {{ Html::style('css/bootstrap.min.css') }}
    {{ Html::style('css/material-design-iconic-font.min.css') }}
    {{ Html::style('css/core.css') }}
    {{ Html::style('css/components.css') }}
    {{ Html::style('css/icons.css') }}
    {{ Html::style('css/pages.css') }}
    {{ Html::style('css/menu.css') }}
    {{ Html::style('css/responsive.css') }}

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->




</head>


<body>


    @include('layout.admin.header')

    @yield('page-body');


    @include('layout.admin.footer')


</body></html>