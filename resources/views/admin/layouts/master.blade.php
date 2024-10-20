<!DOCTYPE html>
{{-- <html lang="en"> --}}
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() =='en' ? 'ltr':'rtl' }}" >
  <head>
   @include('admin.layouts.headcss')
   @yield('css')
  </head>
  <body class="app sidebar-mini">
    @include('sweetalert::alert')
    {{-- @include('admin.partials._errors') --}}
    @include('admin.layouts.navbar')
    @include('admin.layouts.sidebar')
    <main class="app-content">
      @yield('content')
    </main>
    @include('admin.layouts.footerjs')
    @stack('js')
  </body>
</html>
