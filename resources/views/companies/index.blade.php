@extends('layouts.app')

@section('content')

<div class="col-md-12 col-lg-12 col-sm-12">

    <div class="panel panel-primary ">
        <div class="panel-heading">Chuyên đề
            <a href="companies/create" class="pull-right btn btn-primary btn-sm "><i class="fas fa-plus-circle"></i>Thêm</a>
        </div>

        <div class="panel-body">
            @foreach($companies as $company)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <a href="/companies/{{$company->id}}">
                            <img src="{{asset('storage/'.$company->company_image)}}" width="100%" height="auto">
                        </a>
                        <div class="caption">
                            <h3><a href="/companies/{{$company->id}}">{{$company->name}}</a></h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
