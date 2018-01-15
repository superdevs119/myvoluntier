@extends('organization.layout.master')

@section('css')
@endsection
@section('content')
    <div class="content-panel">
        <div class="wrapper wrapper-content">
            <div class="row">
                <div class="col-lg-12 animated fadeInRight impact-panel" style="margin-top: 0">
                    <div class="impact-tracked-hours">
                        <a href="{{url('organization/post_opportunity')}}" class="btn btn-primary"><i class="fa fa-plus"></i> New Opportunity</a>
                    </div>
                    <div class="divider"></div>

                    <div class="panel-body">
                        <div class="detail_header">
                            <h2><i class="fa fa-globe"></i> My Opportunities</h2>
                        </div>
                        <div class="tabs-container">
                            <div class="tabs-left">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-details"> Active</a></li>
                                    <li><a data-toggle="tab" href="#tab-opportunities"> Expired</a></li>
                                </ul>
                                <div class="tab-content ">
                                    <div id="tab-details" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="detail_header">
                                                <h2><i class="fa fa-ioxhost"></i> Active Opportunities</h2>
                                            </div>
                                            <div class="detail_content">
                                                @foreach($active_oppors as $op)
                                                    <div class="org-oppor-detail">
                                                        <div class="img-logo">
                                                            <img alt="image" class="img-circle" <?php if($op->logo_img == NULL){ ?>src="<?=asset('img/logo/opportunity-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$op->logo_img}} <?php }?>">
                                                        </div>
                                                        <div class="detail-text">
                                                            <a href="{{url('/organization/view_opportunity')}}/{{$op->id}}"><h2>{{$op->title}}</h2></a>
                                                            <h3>Opportunity</h3>
                                                            <p>{{$op->description}}</p>
                                                        </div>
                                                        <div class="opp-actions">
                                                            <a href="{{url('/organization/edit_opportunity')}}/{{$op->id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                            <button value="{{$op->id}}" class="btn_delete btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div id="tab-opportunities" class="tab-pane">
                                        <div class="panel-body">
                                            <div class="detail_header">
                                                <h2><i class="fa fa-ioxhost"></i>  Expired Opportunities</h2>
                                            </div>
                                            <div class="detail_content">
                                                @foreach($expired_oppors as $ex_op)
                                                    <div class="org-oppor-detail">
                                                        <div class="img-logo">
                                                            <img alt="image" class="img-circle" <?php if($ex_op->logo_img == NULL){ ?>src="<?=asset('img/logo/opportunity-default-logo.png') ?>" <?php }else{ ?> src="<?=asset('uploads') ?>/{{$ex_op->logo_img}} <?php }?>">
                                                        </div>
                                                        <div class="detail-text">
                                                            <a href="{{url('/organization/view_opportunity')}}/{{$ex_op->id}}"><h2>{{$ex_op->title}}</h2></a>
                                                            <h3>Opportunity</h3>
                                                            <p>{{$ex_op->description}}</p>
                                                        </div>
                                                        <div class="opp-actions">
                                                            <a href="{{url('/organization/edit_opportunity')}}/{{$ex_op->id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                                            <button value="{{$ex_op->id}}" class="btn_delete btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script>
        $('.btn_delete').click(function (e) {
            var $div = $(this).parent().parent();
            var oppr_id = $(this).val();
            var url = API_URL + 'organization/delete_opportunity';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            console.log();
            var type = "post";
            var formData = {
                oppr_id: oppr_id,
            }
            $.ajax({
                type: type,
                url: url,
                data: formData,
                success: function (data) {
                    $div.hide();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        })
    </script>
@endsection
