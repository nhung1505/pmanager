@extends('layouts.app')
@section('content')
<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
    <!-- The justified navigation menu is meant for single line per list item.
         Multiple lines will require custom code not provided by Bootstrap. -->
    <!-- Jumbotron -->
    <div class="well well-lg">
        <h1>{{$project->name}}</h1>
        <p class="lead">{{$project->description}}</p>
    </div>
    <!-- Example row of columns -->
    <div class="row col-md-12 col-sm-12 col-lg-12" style="background: white; margin: 10px">
        {{--<a href="{{route('projects.create')}}" class="btn btn-default btn-sm pull-right">Add Project</a>--}}
        <br/>

        @include('partials.comments')

        <div class="row container-fluid">
            <form action="{{route('comments.store')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="commentable_type" value="App\Models\Project">
                <input type="hidden" name="commentable_id" value="{{$project->id}}">
                <div class="form-group">
                    <lable for="comment-content">Comment <span class="required">*</span></lable>
                    <textarea class="form-control autosize-target text-left" rows="3" placeholder="Enter Comment" id="comment-content" name="body" spellcheck="false" required ></textarea>
                </div>
                <div class="form-group">
                    <lable for="comment-content">Proof of work done (Url/Photos) <span class="required">*</span></lable>
                    <textarea class="form-control autosize-target text-left" rows="2" style="resize: vertical" placeholder="Enter url or screenshots" id="comment-content" name="url" spellcheck="false" required ></textarea>
                </div>
                <div class="form-group ">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="sidebar-module">
        <div class="sidebar-module">
            <h4>Action</h4>
            <ol class="list-unstyled">
                <li><a href="/projects/{{$project->id}}/edit"><i class="fas fa-edit"></i>Edit</a></li>
                <li><a href="/projects/create"><i class="fas fa-plus-circle"></i>Create new Project</a></li>
                <li><a href="/projects"><i class="far fa-user"></i>My Project</a></li>
                <br/>
                @if($project->user_id == Auth::user()->id)
                    <li><a data-toggle="modal" data-target="#confirmDelete-{{$project->id}}"><i class="far fa-trash-alt"></i> Delete</a></li>
                    <form action="{{route('companies.destroy',[$project->id])}}" method="post">
                        {{ csrf_field() }}
                        <div class="modal fade" id="confirmDelete-{{$project->id}}" role="dialog">
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
                @endif
            </ol>
            <hr/>
            <h4>Add members</h4>
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <form action="{{route('projects.adduser')}}" id="add-user" method="post">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="hidden" class="form-control" name="project_id" value="{{$project->id}}">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="submit">Add!</button>
                             </span>
                        </div><!-- /input-group -->
                    </form>
                </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
            <br>    

            <h4>Team Members</h4>
            <ol class="list-unstyled">
                @foreach($project->users as $user)
                <li><a href="">{{$user->email}}</a></li>
                @endforeach
            </ol>



        </div>
    </div>
</div>
@endsection



