@extends('adminlte::page')

@section('title', 'Pegasus')


@section('content_header')

@stop


@section('content')
    {{-- List of model --}}
    {{ csrf_field() }}
    @php($index = 'crud/'.$model)
    @php($fetch = 'crud/fetchdata/'.$model)
    @php($post  = 'crud/postdata/'.$model)
    @php($get   = 'crud/getdata/'.$model)


    <div class="box box-sucess">
        <div class="box-header">
            <h3 class="box-title">{{ucwords($model)}}</h3>
            <div align="right">
                <button name="add" id="add_data" class="edit-modal btn glyphicon glyphicon-plus-sign" title="Cadastrar novo item" data-toggle="tooltip"  > </button> 
            </div>
        </div>    

        <div class="box-body">
            <div class="box-body table-responsive no-padding">
                <table id="dataTable" class="table table-hover table-bordered" >
                    <thead>
                        <tr>
                            @foreach ($showables as $field)
                            @if($field['datatable']=='true') 
                            <th>{{$field['title']}}</th>
                            @endif
                            @endforeach
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    
               </table>
           </div>
       </div>
    </div>

    {{-- Modal Form --}}

    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="post" id="formdata">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Data</h4>
                    </div>
                    <div class="modal-body">
                        {{csrf_field()}}
                        <span id="form_output"></span>
                        <div id="formfields">
                            @foreach ($showables as $field)
                            @if($field['form']=='true') 
                            <div id="form_input" class="form-group">
                                @if($field['type']=='text') 
                                <label>{{$field['title']}}</label>
                                <input type="text" name="{{$field['name']}}" id="{{$field['name']}}" class="form-control" />
                                @endif
                            </div>
                            @endif
                            @endforeach
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id" id="id" value="" />
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
    $('#dataTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "{{ url($get) }}",
        "columns":[
            @foreach ($showables as $field)
            @if($field['datatable']=='true') 
            { "data": "{{$field['name']}}" },
            @endif
            @endforeach
            { "data": "action", orderable:false, searchable: false}
        ]    
    });

    $('#add_data').click(function(){
        $('#formModal').modal('show');
        $('#formdata')[0].reset();
        $('#form_output').html('');
        $('#button_action').val('insert');
        $('#action').val('Add');
        $('#formfields').show();
        $('.modal-title').text('Add Data');
    });

    $(document).on('click', '.edit', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        $('#formfields').show();
        $.ajax({
            url:"{{url($fetch)}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {
                //Coloca os valores nos formulario
                @foreach ($showables as $field)
                @if($field['form']=='true') 
                $('#{{$field["name"]}}').val(data.{{$field["name"]}});
                @endif
                @endforeach
                $('#id').val(id);
                $('#formModal').modal('show');
                $('#action').val('Edit');
                $('.modal-title').text('Edit Data');
                $('#button_action').val('update');
            }
        })
    });


    $(document).on('click', '.delt', function(){
        var id = $(this).attr("id");
        $('#form_output').html('');
        $('#formfields').hide();
        
        $.ajax({
            url:"{{url($fetch)}}",
            method:'get',
            data:{id:id},
            dataType:'json',
            success:function(data)
            {
                $('#name').val(data.name);
                $('#id').val(id);
                $('#formModal').modal('show');
                $('#action').val('Delete');
                $('.modal-title').text('Delete :'+data.name+'?');
                $('#button_action').val('delete');
            }
        })
    });

   
    $('#formdata').on('submit', function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"{{ url($post) }}",
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
                    $('#formModal').modal('hide');
                    $('#dataTable').DataTable().ajax.reload();
                }
            }
        })
    });

    $(document).on('click', '.slct', function(){
        var id = $(this).attr("id");
              
        $.ajax({
            url:"company/"+id,
            method:'get',
            dataType:'json',
            success:function(data)
            {
                window.location ="{{ url($index) }}";

            }
        })
    })


});
</script>
@stop

