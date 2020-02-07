<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <!-- build:css(.) styles/vendor.css -->
    <!-- bower:css -->
    <link rel="stylesheet" href="{{ asset('aplicacion/bower_components/bootstrap/dist/css/bootstrap.css')}}" />
    <!-- endbower -->
    <!-- endbuild -->
    <!-- build:css(.tmp) styles/main.css -->
    <link rel="stylesheet" href="{{ asset('aplicacion/app/styles/main.css') }}">
    <!-- endbuild -->
  </head>
  <body ng-app="publicApp">
    <!--[if lte IE 8]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Add your site or application content here -->
    <div class="header">
      <div class="navbar navbar-default" role="navigation">
        <div class="container">
          <div class="navbar-header">

            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#js-navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

            <a class="navbar-brand" href="#/">public</a>
          </div>

          <div class="collapse navbar-collapse" id="js-navbar-collapse">

            <ul class="nav navbar-nav">
              <li class="active"><a href="#/">Home</a></li>
              <li><a ng-href="#/about">About</a></li>
              <li><a ng-href="#/">Contact</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
    <div ng-view=""></div>
    </div>

    <div class="footer">
      <div class="container">
        <p><span class="glyphicon glyphicon-heart"></span> from the Yeoman team</p>
      </div>
    </div>


    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID -->
     <script>
       !function(A,n,g,u,l,a,r){A.GoogleAnalyticsObject=l,A[l]=A[l]||function(){
       (A[l].q=A[l].q||[]).push(arguments)},A[l].l=+new Date,a=n.createElement(g),
       r=n.getElementsByTagName(g)[0],a.src=u,r.parentNode.insertBefore(a,r)
       }(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

       ga('create', 'UA-XXXXX-X');
       ga('send', 'pageview');
    </script>

    <!-- build:js(.) scripts/vendor.js -->
    <!-- bower:js -->
    <script src="{{ asset('aplicacion/bower_components/jquery/dist/jquery.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/angular/angular.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/bootstrap/dist/js/bootstrap.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/angular-animate/angular-animate.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/angular-cookies/angular-cookies.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/angular-messages/angular-messages.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/angular-resource/angular-resource.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/angular-route/angular-route.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/angular-sanitize/angular-sanitize.js') }}"></script>
    <script src="{{ asset('aplicacion/bower_components/angular-touch/angular-touch.js') }}"></script>
    <!-- endbower -->
    <!-- endbuild -->

        <!-- build:js({.tmp,app}) scripts/scripts.js -->
        <script src="{{ asset('aplicacion/app/scripts/app.js') }}"></script>
        <script src="{{ asset('aplicacion/app/scripts/controllers/main.js') }}"></script>
        <script src="{{ asset('aplicacion/app/scripts/controllers/about.js') }}"></script>
        <script src="{{ asset('aplicacion/app/scripts/controllers/login.js') }}"></script>
        <script src="{{ asset('aplicacion/app/scripts/services/login.js') }}"></script>
        <!-- endbuild -->
</body>
</html>
