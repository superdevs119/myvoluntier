@extends('organization.layout.master')

@section('css')
    <link href="<?=asset('css/plugins/footable/footable.core.css')?>" rel="stylesheet">
    <style>
        img{width: 70px;}
    </style>
@endsection

@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel" style="margin-top: 0">
                    <div class="impact-tracked-hours">
                    </div>
                    <div class="divider"></div>

                    <div class="panel-body">
                        <div class="detail_header">
                            <h2><i class="fa fa-user-plus"></i> My Friends</h2>
                            <table class="friend-table table table-stripped" data-page-size="10" data-filter=#filter>
                                <tbody>

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="4" style="padding :20px 0 0">
                                        <ul class="pagination pull-right"></ul>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection

@section('script')
            <script src="<?=asset('js/plugins/footable/footable.all.min.js')?>"></script>
            <script>
                $(document).ready(function() {
                    $('.friend-table').footable();
                });
            </script>
@endsection
