

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