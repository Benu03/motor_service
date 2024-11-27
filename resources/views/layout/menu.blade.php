<style type="text/css" media="screen">
  .nav ul li p !important {
    font-size: 12px;
  }
  .infoku {
    margin-left: 20px; 
    text-transform: uppercase;
    color: yellow;
    font-size: 11px;
  }
</style>
<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #03830a; border-top-right-radius: 15px;">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link d-flex flex-column align-items-center" style="height: auto;">
      <img id="logo_wrap" alt="TS3 Indonesia" class="brand-image-xl py-1" src="{{ asset('assets/upload/image/logo.png') }}">
      <span id="logo_title" class="text-center" style="font-size: 22px; font-weight: bold;">TS3 Indonesia</span>
    </a>

    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


            {{-- looping menu di sini --}}



          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const logoWrap = document.getElementById('logo_wrap');
      const logoTitle = document.getElementById('logo_title');
      const sidebarToggle = document.querySelector('[data-widget="pushmenu"]'); 
  
      sidebarToggle.addEventListener('click', function () {
        const isSidebarCollapsed = document.body.classList.contains('sidebar-collapse');
  
        if (isSidebarCollapsed) {
          // Sidebar collapsed: ganti logo dan tampilkan title
          logoWrap.src = "{{ asset('assets/upload/image/logo.png') }}";
          logoWrap.style.width = "60px";
          logoTitle.style.display = "block";
        } else {
          // Sidebar expanded: kembalikan ke logo default dan sembunyikan title
          logoWrap.src = "{{ asset('assets/upload/image/logo.png') }}";
          logoWrap.style.width = "60px";
          logoTitle.style.display = "none"; 
        }
      });
    });
  </script>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card" style="margin-top: 35px;">
            <div class="card-header">
              <div class="row">
              <div class="col-md-12">
                 <h2 class="card-title"><?php echo $title ?></h2> 
              </div>
             
              
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">



              