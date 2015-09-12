@extends('layouts.admin')

@section('title')
    <b>Content And Announcements</b>
    <span class='pull-right'><A href='{{route("misc.content.create" , false)}}' class='btn btn-success'><i class='fa fa-plus'></i> Create new Content</A> </span> 
@stop

@section('body')


<table class="table table-stripe">
        <thead>
        <tr>
            <th>Title</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contents as $content)
        <tr>
            <td><b>{{(strlen($content->title) >= 40 ? substr($content->title, 0,40)."..."  : $content->title)}}</b></td>
            <td><b>{{(strlen($content->content) >= 40 ? substr($content->content, 0,40)."..."  : $content->content)}}</b></td>
            <td class="edit"><button  data-id="{{$content->id}}" data-value="{{$content->value}}" data-route="{{url('/misc/set-information/')}}"   class='btn-edit btn btn-block btn-primary'><i class="fa fa-edit"></i>Edit</button></td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                  
                    <li></li>
                  </ul>
                </nav>
            </td>
        </tr>

        </tfoot>

        </table>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.edit').delegate('.btn-edit' ,'click', function(){
                var url = $(this).data('route') + "/" + $(this).data('id') +"/";
                swal({   
                   title: "Enter new value for " + $(this).data('keyname'),   
                   text: "Information ID: " + $(this).data('id'),
                   type: "input",   
                   showCancelButton: true,   
                   closeOnConfirm: false,  
                   animation: "slide-from-top",  
                   inputPlaceholder: "Write something" }, 
                   function(inputValue){   
                    if (inputValue === false) return false;      
                    if (inputValue === "") {     
                        swal.showInputError("You need to write something!");     return false   
                    } 
                   inputValue=  inputValue.replace(/\//gi, "-");
                    window.location.assign(url + inputValue);

                    swal("Nice!", "You wrote: " + inputValue, "success"); 
                   });
            });
        });
    </script>
@stop