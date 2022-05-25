@extends('backend.admin.layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
       

        <!-- Main content -->
        <section class="content pt-3">
            <div class="container-fluid">
                <div class="row">
                <div class="tree">
                <ul>
                <li>
                <a href="#">Admin</a>
                <ul>
                <li>
                    <a href="#">Project Manager</a>
                    <ul>
                        <li>
                            <a href="#">Team lead</a>
                        <ul>
                        <li>
                            <a href="#">Team member 1</a>
                        </li>
                        <li>
                            <a href="#">Team member 2</a>
                        </li>
                        </ul>
                        </li>
                        <li>
                            <a href="#">Team lead</a>
                        </li>
                    </ul>
                    </ul>
                </li>
                </li>
                <li>
                    <a href="#">Project Manager</a>
                    <ul>
                        <ul>
                        <li>
                            <a href="#">Team lead</a>
                        <ul>
                        <li>
                            <a href="#">Team member 1</a>
                        </li>
                        <li>
                            <a href="#">Team member 2</a>
                        </li>
                        </ul>
                        </li>
                        <li>
                            <a href="#">Team lead</a>
                        </li>
                    </ul>
                    </ul>
                </li>
                </ul>
                </li>
                </ul>
</div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')
@endsection
