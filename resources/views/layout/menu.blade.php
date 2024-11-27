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

            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
             @php
                $menus = \DB::connection('mtr')->table('mst.mst_menu')
                    ->leftJoin('mst.mst_role_menu', 'mst.mst_menu.id', '=', 'mst.mst_role_menu.mst_menu_id')
                    ->leftJoin('mst.mst_user_role', 'mst.mst_role_menu.mst_user_role_id', '=', 'mst.mst_user_role.id')
                    ->where('mst_user_role.role_name', session()->get('modules')['role'])
                    ->where('mst_menu.is_active', true)
                    ->orderBy('mst.mst_menu.menu_order', 'asc')
                    ->select('mst.mst_menu.*', 'mst.mst_role_menu.mst_user_role_id', 'mst.mst_user_role.role_name')
                    ->get();

                // Group the menus by their parent ID
                $menuTree = $menus->groupBy('menu_parent');
                @endphp

                @foreach ($menuTree[0] as $parent)
                    @php
                        $hasChildren = isset($menuTree[$parent->id]) && count($menuTree[$parent->id]) > 0;
                        $isParentActive = Request::is(ltrim($parent->menu_url, '/') . '*');
                    @endphp

                    {{-- Parent Menu --}}
                    <li class="nav-item {{ $hasChildren ? 'has-treeview' : '' }} {{ $isParentActive ? 'menu-is-opening menu-open' : '' }}">
                        <a href="{{ $hasChildren ? '#' : route($parent->menu_url) }}" class="nav-link">
                            <i class="{{ $parent->menu_icon }} nav-icon"></i>
                            <p>
                                {{ $parent->menu_name }}
                                @if ($hasChildren)
                                    <i class="fas fa-angle-left right"></i>
                                @endif
                            </p>
                        </a>

                        {{-- Children Menu --}}
                        @if ($hasChildren)
                            <ul class="nav nav-treeview">
                                @foreach ($menuTree[$parent->id] as $child)
                                    @php
                                        $isChildActive = Request::is(ltrim($child->menu_url, '/') . '*');
                                    @endphp
                                    <li class="nav-item ml-4 {{ $isChildActive ? 'active' : '' }}">
                                        <a href="{{ route($child->menu_url) }}" class="nav-link">
                                            <i class="{{ $child->menu_icon }} nav-icon"></i>
                                            <p>{{ $child->menu_name }}</p>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach


                <div style="margin-top: 80px;"></div>




          
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



              