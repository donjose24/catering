@extends('layouts.home')

@section('body')

                 {{ Form::open(['route' => 'home.contact.save', 'role' => 'form']) }}
 <div class="service-wrapper">
    <fieldset>
             <legend>
                 <div>
                     <h3>Contact Us</h3>
                 </div>
             </legend>
             <div class="form-group">
                 <label class="col-lg-3 control-label">Subject:</label>
                 <div class="col-lg-8">
                {{ Form::text('subject','',['class' => 'form-control', 'placeholder' => 'Title of Concern', 'autofocus' => 'true', 'required']) }}
             </div>
             </div>
             <div class="form-group">
                 <label class="col-lg-3 control-label">Details:</label>
                 <div class="col-lg-8">
                {{ Form::textarea('details','',['class' => 'form-control', 'placeholder' => '', 'required']) }}
             </div>
             </div>
             <div class="form-group">
                 <label class="col-lg-3 control-label">Name:</label>
                 <div class="col-lg-8">
                {{ Form::text('name','',['class' => 'form-control', 'placeholder' => 'Name', 'required']) }}
             </div>
             </div>

             <div class="form-group">
                 <div class="col-lg-10 col-lg-offset-2">
                     <button type="cancel" class="btn btn-default" value="Cancel" style="margin-right:20px;"> Cancel</button>
                     <button type="submit" class="btn btn-primary" value="Reserve"> Submit</button>
                 </div>
             </div>
         </fieldset>
     {{Form::close()}}
</div>
@stop