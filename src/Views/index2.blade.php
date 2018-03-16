@extends('layouts.admin.main')

@section('title', 'Ordering')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet"
          href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Ordering</h1>
            {{--<ol class="breadcrumb">--}}
            {{--<ol class="breadcrumb">--}}
            {{--<li><a href="{{ route('admin/albums') }}"><i class="fa fa-dashboard"></i> Albums</a></li>--}}
            {{--<li><a href="#">Tracks</a></li>--}}
            {{--</ol>--}}
            {{--</ol>--}}
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6 col-md-6">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ $config['box_title'] }}<span
                                        style="color: #3c8dbc">{{ $parent->title }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="reorderHelper" class="alert alert-info" style="display:none;">1. Drag rows to
                                reorder.<br>2. Click 'Save Reordering' when finished.
                            </div>


                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    @foreach($config['fields_to_show'] as $field)
                                        <th>{{ ucfirst($field) }}</th>
                                    @endforeach
                                </tr>
                                </thead>
                                <tbody class="reorder_ul reorder-items-list">
                                @foreach($rows as $row)

                                    <tr id="item_<?php echo $row->id; ?>" class="ui-sortable-handle">
                                        <a href="javascript:void(0);" style="float:none;" class="item_link">
                                            @foreach($config['fields_to_show'] as $field)
                                                @if($field != 'thumb')
                                                    <td>{{ $row->$field }}</td>
                                                @else
                                                    <td><img src="{{ asset($config['path_to_image'] . $row->file) }}"
                                                             alt="" height="100px"></td>
                                                @endif
                                            @endforeach
                                        </a>
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>


                            <div class="box-footer">
                                <a href="javascript:void(0);" class="reorder_link btn btn-primary pull-right"
                                   id="saveReorder">Reorder rows</a>
                                <a href="{{ action($backUrl, [$parentId, $parent->id]) }}" class="btn btn-default">Back</a>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <!-- page script -->
    <script>
        $(document).ready(function () {
            $('.reorder_link').on('click', function () {
                $("tbody.reorder-items-list").sortable({tolerance: 'pointer'});
                $('.reorder_link').html('Save');
                $('.reorder_link').attr("id", "saveReorder");
                $('#reorderHelper').slideDown('slow');
                $('.item_link').attr("href", "javascript:void(0);");
                $('.item_link').css("cursor", "move");
                $("#saveReorder").click(function (e) {
                    if (!$("#saveReorder i").length) {
                        $(this).html('').prepend('<img src="images/refresh-animated.gif"/>');
                        $("tbody.reorder-items-list").sortable('destroy');
                        $("#reorderHelper").html("Reordering Rows - This could take a moment. Please don't navigate away from this page.").removeClass('light_box').addClass('notice notice_error');

                        var h = [];
                        $("tbody.reorder-items-list tr").each(function () {
                            h.push($(this).attr('id').substr(5));
                        });

                        console.log(h);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "POST",
                            url: '{{ $url }}',
                            data: {ids: " " + h + ""},
                            success: function () {
                                window.location.reload();
                            }
                        });
                        return false;
                    }
                    e.preventDefault();
                });
            });
        });
    </script>
@endsection