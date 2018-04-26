@extends('layouts.app')
@section('content')
    <div class="col-md-9 col-lg-9 col-sm-9 pull-left" style="background: white">
        <h1>Update new Project</h1>
        <!-- The justified navigation menu is meant for single line per list item.
     Multiple lines will require custom code not provided by Bootstrap. -->
        <!-- Jumbotron -->
        <!-- Example row of columns -->
        <div class="row col-md-12 col-lg-12 col-sm-12 " style="background: white; margin: 10px">
            <form action="{{route('projects.update', [$project->id])}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">

                <div class="form-group">
                    <lable for="company-name">Name <span class="required">*</span></lable>
                    <input
                            type=""
                            class="form-control"
                            placeholder="Enter Name"
                            value="{{$project->name}}"
                            id="company-name" name="name"
                            spellcheck="false"
                            required >
                </div>

                <div class="form-group">
                    <lable for="company-content">Name <span class="required">*</span></lable>
                    <textarea
                            class="form-control autosize-target text-left"
                            rows="5"
                            placeholder="Enter Description"
                            id="company-content"
                            name="description"
                            spellcheck="false"
                            required >
                        {{$project->description}}
                    </textarea>
                </div>
                <div class="form-group ">
                    <input type="submit" class="btn btn-primary" value="Submit">
                </div>
            </form>

        </div>
    </div>

    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
        <div class="sidebar-module">
            <div class="sidebar-module">
                <h4>Action</h4>
                <ol class="list-unstyled">
                    <li><a href="/companies/{{$project->id}}">View projects</a></li>
                    <li><a href="/companies">List projects</a></li>
                </ol>
            </div>
        </div>
    </div>

@endsection