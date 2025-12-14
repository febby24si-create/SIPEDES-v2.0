<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Sistem Desa')</title>
  <link rel="shortcut icon" type="image/png" href="{{ asset('assets/images/logos/seodashlogo.png') }}" />
  
  {{-- <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.min.css') }}" />
  <link rel="stylesheet" href="{{ asset('assets/css/whatsaap.css') }}" /> --}}

  @include('layouts.admin.css')

  @stack('styles')
</head>

<body>
  <!-- Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    <!-- Sidebar -->
    @include('layouts.admin.sidebar')
    
    <!-- Main Wrapper -->
    <div class="body-wrapper">
      <!-- Header -->
      @include('layouts.admin.header')
      
      <!-- Main Content -->
      <div class="container-fluid">
            @include('pages.partials.alert')
        @yield('content')
      </div>
          <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/628708230676?text=Halo%20Admin%20SIPEDES,%20saya%20ingin%20bertanya." 
        class="whatsapp-float" target="_blank" title="Chat via WhatsApp">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>
      <!-- Footer -->
      @include('layouts.admin.footer')
    </div>
  </div>
  
  <!-- JavaScript -->
  @include('layouts.admin.js')
  @stack('scripts')
</body>

</html>