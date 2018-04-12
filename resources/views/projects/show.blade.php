

@extends('layouts.app')
@section('content')

     <div class="col-md-9 col-lg-9">

      <!-- Jumbotron -->
      <div class="well">
      <h1>{{$project->name}}</h1>
        <p class="lead description">{{$project->description}}}</p>
        <p class="lead">{{$project->days}} days</p>

        {{--  <p><a class="btn btn-lg btn-success" href="#" role="button">Get started today</a></p>  --}}
      </div>
      <div class="container-fluid">
      <div class="row" style="background:white;margin:10px;">
        {{--  <a href="/comments/create" class="btn btn-default btn-sm pull-right">Add comment</a>  --}}
@foreach ($project->comments as $comment)
{{$comment->user->first_name}} {{$comment->user->last_name}} 
{{$comment->body}}
<br/>
@endforeach

          <form method="post" action="{{ route('comments.store') }}">
                                {{ csrf_field() }}
                                <input   
                                class="form-control"
                                type="hidden"
                                        name="commentable_type"
                                        value="App\Project"
                                         />
                                <input   
                                class="form-control"
                                type="hidden"
                                        name="commentable_id"
                                        value="{{ $project->id }}"
                                                  />
                             
                                {{--  <div class='form-group'>
                                    <label for="company_name">Name<span class="required">*</span></label>
                                    <input 
                                    placeholder="Enter Company name"
                                    id="company_name"
                                    required
                                    name="company_name"
                                    spellcheck="false"
                                    class="form-control"
                                    />
                                    @if ($errors->has('company_name'))
                                    <div class="alert alert-danger">
                                            {{ $errors->first('company_name') }} <br>
                                    </div>
                                    @endif
                                </div>  --}}
    
    
                                <div class="form-group">
                                    <label for="body">comment</label>
                                    <textarea placeholder="Enter description" 
                                              style="resize: vertical" 
                                              id="body"
                                              name="body"
                                              rows="5" spellcheck="false"
                                              class="form-control autosize-target text-left">
    
                                              
                                              </textarea>
                                              @if ($errors->has('body'))
                                              <div class="alert alert-danger">
                                                      {{ $errors->first('body') }} <br>
                                              </div>
                                              @endif
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary"
                                           value="Submit"/>
                                </div>
                            </form>
       
    
          
      </div>
    </div>

      <!-- Example row of columns -->
      <footer class="footer">
            <p>ghada © Company 2018</p>
        </footer>
     </div>
     <div class="col-sm-3 offset-sm-1 blog-sidebar">
            <div class="sidebar-module">
            
             
                <div class="panel panel-primary">
                      <div class="panel-heading">
                        <h3 class="panel-title text-capitalize">{{$project->user->first_name." ".$project->user->last_name }}</h3>
                      </div>
                      <div class="panel-body capitalize">
                          {{$project->user->city}}
                          <br/>
                          <a href="#" class="btn btn-primary">Details</a>
                      </div>
                    </div>
                    <h4>Actions</h4>
                    <ol class="list-unstyled">
                      @if(Auth::user()->id == $project->user_id)
                      <li><a href="/projects/{{$project->id}}/edit">Edit</a></li>
                      @endif
                      <li><a href="/projects/create">Add new project</a></li>
                      @if(Auth::user()->id == $project->user_id)
                      <li>
                        <a   
                        href="#"
                            onclick="
                            var result = confirm('Are you sure you wish to delete this project?');
                                if( result ){
                                        event.preventDefault();
                                        document.getElementById('delete-form').submit();
                                }
                                    "
                                    >
                            Delete
                        </a>
          
                        <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}" 
                          method="POST" style="display: none;">
                                  <input type="hidden" name="_method" value="delete">
                                  {{ csrf_field() }}
                        </form>
                      </li>
                      @endif
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


