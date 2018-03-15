

@extends('layouts.app')
@section('content')

     <div class="col-md-9 col-lg-9">

      <!-- Jumbotron -->
      <div class="jumbotron">
      <h1>{{$company->name}}</h1>
        <p class="lead">{{$company->description}}}</p>
        {{--  <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>  --}}
      </div>

      <!-- Example row of columns -->
      <div class="row" style="background:white;margin:10px;">
        <a href="/projects/create/{{$company->id}}" class="btn btn-default btn-sm pull-right">create project</a>
        @foreach ($company->projects as $project)
            <div class="col-lg-4">
                <h2>{{$project->name}}</h2>
                <p>{{$project->description}}</p>
                <p><a class="btn btn-primary" href="/projects/{{$project->id}}" role="button">View details »</a></p>
            </div>
        @endforeach
      </div>
      <footer class="footer">
            <p>ghada© Company 2017</p>
        </footer>
     </div>
     <div class="col-sm-3 offset-sm-1 blog-sidebar">
            <div class="sidebar-module">
                    <h4>Actions</h4>
                    <ol class="list-unstyled">
                      <li><a href="/companies/{{$company->id}}/edit">Edit</a></li>
                      <li>
                        <a   
                        href="#"
                            onclick="
                            var result = confirm('Are you sure you wish to delete this Company?');
                                if( result ){
                                        event.preventDefault();
                                        document.getElementById('delete-form').submit();
                                }
                                    "
                                    >
                            Delete
                        </a>
          
                        <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}" 
                          method="POST" style="display: none;">
                                  <input type="hidden" name="_method" value="delete">
                                  {{ csrf_field() }}
                        </form>
                      </li>
                      <li><a href="#">Add new user</a></li>
                    </ol>
                  </div>
            {{--  <div class="sidebar-module">
              <h4>users</h4>
              <ol class="list-unstyled">
                <li><a href="#">March 2014</a></li>
                <li><a href="#">February 2014</a></li>
                <li><a href="#">January 2014</a></li>
                <li><a href="#">December 2013</a></li>
                <li><a href="#">November 2013</a></li>
                <li><a href="#">October 2013</a></li>
                <li><a href="#">September 2013</a></li>
                <li><a href="#">August 2013</a></li>
                <li><a href="#">July 2013</a></li>
                <li><a href="#">June 2013</a></li>
                <li><a href="#">May 2013</a></li>
                <li><a href="#">April 2013</a></li>
              </ol>
            </div>  --}}
         
     </div>
      <!-- Site footer -->
     

@endsection


