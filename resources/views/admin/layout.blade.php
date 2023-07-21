@include('admin.header')
<!-- /.navbar -->

<!-- Main Sidebar Container -->
@include('admin.sidebar', ['active' => 'dashboard'])
<!-- Content Wrapper. Contains page content -->
<div class="content">
    <div class="container-fluid">
        <div class="content-wrapper">

            <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@yield('page_title', 'page_title')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">@yield('sub', 'sub')</li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
            <!-- Content Header (Page header) -->
            @yield('content')
            <!-- /.content -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- /.content-wrapper -->

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->

@include('admin.footer')
