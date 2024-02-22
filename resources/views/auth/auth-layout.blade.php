<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" class="dark" data-header-styles="dark" data-menu-styles="dark" data-toggled="close">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Restore Log In</title>
    <meta name="description" content="A Tailwind CSS admin template is a pre-designed web page for an admin dashboard. Optimizing it for SEO includes using meta descriptions and ensuring it's responsive and fast-loading.">
    <meta name="keywords" content="html dashboard,tailwind css,tailwind admin dashboard,template dashboard,html and css template,tailwind dashboard,tailwind css templates,admin dashboard html template,tailwind admin,html panel,template tailwind,html admin template,admin panel html">

    <!-- Main Theme Js -->
    <script src="{{asset('assets/js/authentication-main.js')}}"></script>
    <!-- Style Css -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
{{--    <!-- Simplebar Css -->--}}
{{--    <link id="style" href="{{asset('assets/libs/simplebar/simplebar.min.css')}}" rel="stylesheet">--}}
{{--    <!-- Color Picker Css -->--}}
{{--    <link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}">--}}

</head>

<body class="">

    <div class="container">
        @yield('login')
        @yield('register')
    </div>

    <!-- Show Password JS -->
    <script src="{{asset('assets/js/show-password.js')}}"></script>
    <!-- Preline JS -->
    <script src="{{asset('assets/libs/preline/preline.js')}}"></script>



{{--Dark Mode Script--}}
  <script>
      localStorage.setItem('ynexdarktheme', 'true');
      localStorage.setItem('ynexHeader', 'dark');
          const defaultTheme = {
              admin: "QR MENU",
              settings: {
                  layout: {
                      name: "Web Menu",
                      toggle: false,
                      darkMode: true,
                      boxed: false
                  }
              },
              reset: true
          };

      localStorage.setItem('theme', JSON.stringify(defaultTheme));
      localStorage.setItem('ynexMenu', 'dark');
      localStorage.setItem('layout-theme', 'dark');
  </script>
</body>

</html>