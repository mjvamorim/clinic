@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop


@section('content')
    {{-- List of model --}}
    {{ csrf_field() }}

    <div class="box box-sucess">
        <div class="box-header">
            <h3 class="box-title">Doctors</h3>
            <div align="right">
                <button name="add" id="add_data" class="edit-modal btn glyphicon glyphicon-plus-sign" title="New Item" data-toggle="tooltip" data-placement="top" > </button> 
            </div>
        </div>    

        <div class="box-body">
            <div class="box-body table-responsive no-padding">
                <table id="doctor_table" class="table table-hover table-bordered" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    
               </table>
           </div>
       </div>
    </div>

    {{-- Modal Form --}}


    <div id="doctorModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="doctor_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Data</h4>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <span id="form_output"></span>
                        <div class="form-group">
                            <label>Enter First Name</label>
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label>Enter Last Name</label>
                            <input type="text" name="email" id="email" class="form-control" />
                        </div>
                    </div>
                    <div class="modal-footer">
                            <input type="hidden" name="doctor_id" id="doctor_id" value="" />
                        <input type="hidden" name="button_action" id="button_action" value="insert" />
                        <input type="submit" name="submit" id="action" value="Add" class="btn btn-info" />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('js')
<script>
$(document).ready(function() {
    $('#doctor_table').DataTable({
       "processing": true,
       "serverSide": true,
       "ajax": "{{ route('admin.doctor.getdata') }}",
       "columns":[
           { "data": "name" },
           { "data": "email" },
           { "data": "action", orderable:false, searchable: false}
       ]
    });

   $('#add_data').click(function(){
       $('#doctorModal').modal('show');
       $('#doctor_form')[0].reset();
       $('#form_output').html('');
       $('#button_action').val('insert');
       $('#action').val('Add');
       $('.modal-title').text('Add Data');
   });

   $('#doctor_form').on('submit', function(event){
       event.preventDefault();
       var form_data = $(this).serialize();
       $.ajax({
           url:"{{ route('admin.doctor.postdata') }}",
           method:"POST",
           data:form_data,
           dataType:"json",
           success:function(data)
           {
               if(data.error.length > 0)
               {
                   var error_html = '';
                   for(var count = 0; count < data.error.length; count++)
                   {
                       error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                   }
                   $('#form_output').html(error_html);
               }
               else
               {
                   $('#form_output').html(data.success);
                   $('#doctor_form')[0].reset();
                   $('#action').val('Add');
                   $('.modal-title').text('Add Data');
                   $('#button_action').val('insert');
                   $('#doctor_table').DataTable().ajax.reload();
               }
           }
       })
   });

   $(document).on('click', '.edit', function(){
       var id = $(this).attr("id");
       $('#form_output').html('');
       $.ajax({
           url:"{{route('admin.doctor.fetchdata')}}",
           method:'get',
           data:{id:id},
           dataType:'json',
           success:function(data)
           {
               $('#name').val(data.name);
               $('#email').val(data.email);
               $('#doctor_id').val(id);
               $('#doctorModal').modal('show');
               $('#action').val('Edit');
               $('.modal-title').text('Edit Data');
               $('#button_action').val('update');
           }
       })
   });

});
</script>
@stop

