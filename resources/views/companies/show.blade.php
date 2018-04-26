@extends('layouts.app')
@section('content')
<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
    <!-- The justified navigation menu is meant for single line per list item.
         Multiple lines will require custom code not provided by Bootstrap. -->
    <!-- Jumbotron -->
    <div class="jumbotron">
        <h1>{{$company->name}}</h1>
        <p class="lead">{{$company->description}}</p>
    </div>

    <!-- Example row of columns -->
    <div class="row" style="background: white; margin: 10px">
        <a href="{{route('projects.create', [$company->id])}}" class="btn btn-default btn-sm pull-right"><i class="fas fa-plus-circle"></i> Add Project</a>
        @foreach($company->projects as $project)
        <div class="col-lg-4">
            <h2>{{$project->name}}</h2>
            <p class="text-danger">{{$project->description}} </p>
            <p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View project »</a></p>
        </div>
            @endforeach
    </div>
</div>

<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="sidebar-module">
        <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
                <li><a href="/companies/{{$company->id}}/edit"><i class="fas fa-edit"></i>Edit</a></li>
                <li><a href="/projects/create/{{$company->id}}"><i class="fas fa-plus-circle"></i> Add Project</a></li>
                <li><a href="/companies"><i class="far fa-user"></i> My Company</a></li>
                <li><a href="/companies/create"><i class="fas fa-plus-circle"></i> Create new Company</a></li>
                <br/>
                {{--<li><a href="" onclick="var result = confirm('are you sure delete')--}}
                        {{--if(result){--}}
                                    {{--event.preventDefault();--}}
                                    {{--document.getElementById('delete form').submit();--}}
                            {{--}">Delete--}}
                    {{--</a>--}}
                {{--</li>--}}
                {{--<form id="delete form" action="{{route('companies.destroy',[$company->id])}}" method="post" style=" display: none">--}}
                    {{--<input type="hidden" name="_method" value="delete">--}}
                    {{--{{csrf_field()}}--}}
                {{--</form>--}}

                <li><a data-toggle="modal" data-target="#confirmDelete-{{$company->id}}"><i class="far fa-trash-alt"></i> Delete</a></li>
                <form action="{{route('companies.destroy',[$company->id])}}" method="post">
                    {{ csrf_field() }}
                    <div class="modal fade" id="confirmDelete-{{$company->id}}" role="dialog">
                        <div class="modal-dialog modal-sm">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title text-danger text-center">{{__('Confim Delete')}}</h4>
                                </div>
                                <div class="modal-body text-danger text-center">
                                    <p>{{__('Are you sure you wish to delete this Project?')}}</p>
                                </div>
                                <input type="hidden" name="_method" value="delete">
                                <div class="modal-footer ">
                                    <button type="submit"  class="btn btn-danger col-md-5 col-lg-5 col-sm-5 pull-left " >{{__('Yes')}}</button>
                                    <button type="button"  class="btn btn-default col-md-5 col-lg-5 col-sm-5 pull-right" data-dismiss="modal">{{__('No')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                {{--<li><a href="#">Add new member</a></li>--}}
            </ol>
        </div>
    </div>
</div>

    @endsection



