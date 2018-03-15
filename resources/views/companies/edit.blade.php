

@extends('layouts.app')
@section('content')

     <div class="col-md-9 col-lg-9">

      <!-- Jumbotron -->
      

      <!-- Example row of columns -->
      <div class="row" style="background:white;margin:10px;">
            <div class="col-md-12 col-lg-12">
               <form method="post" action="{{route('companies.update',[$company->id])}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                <div class='form-group'>
                    <label for="company_name">Name<span class="required">*</span></label>
                    <input 
                    placeholder="Enter Company name"
                    id="company_name"
                    required
                    name="company_name"
                    spellcheck="false"
                    class="form-control"
                    value="{{$company->name}}">
                    @if ($errors->has('company_name'))
                    <div class="alert alert-danger">
                            {{ $errors->first('company_name') }} <br>
                    </div>
                    @endif
                </div>
                <div class='form-group'>
                        <label for="desription">Description<span class="required">*</span></label>
                        <textarea 
                        placeholder="Enter description"
                        id="description"
                        required
                        rows="5"
                        name="description"
                        spellcheck="false"
                        class="form-control"
                        >{{$company->description}}</textarea>
                        @if ($errors->has('description'))
                        <div class="alert alert-danger">
                                {{ $errors->first('description') }} <br>
                        </div>
                        @endif
                    </div>    
                    <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="submit">
                        </div>        
                </form>
            </div>
            
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
                      <li><a href="#">Delete</a></li>
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


