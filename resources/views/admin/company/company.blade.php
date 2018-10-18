@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')

@stop

@section('content')
    {{-- <div layout:include="MensagemGeral"></div> --}}
    {{ csrf_field() }}

    <div class="box box-sucess">
        <div class="box-header">
            <button class="edit-modal btn glyphicon glyphicon-plus-sign" hover="Novo" data-info=""> </button> 
            <h3 class="box-title">Empresas</h3>
        </div>    
         
        <div class="box-body">
            @foreach ($columns as $col)
                <p>{{ $col }}</p>
            @endforeach
            {{-- @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif --}}
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered data-table" id="table1">
                   <thead>
                    <tr>
                        <th class="text-center col-md-1">#</th>
                        <th class="col-md-4">Empresa</th>
                        <th class="text-center col-md-1">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companies as $company)                        
                    <tr>
                        <td class="text-center">{{$company->id}}</td>
                        <td>{{$company->name}}</td>
                        <td>
                            <button class="edit-modal btn fa fa-edit"
                                data-info="{{$company->id}},{{$company->name}},{{$company->zipcode}},
                                        {{$company->address1}},{{$company->address2}},{{$company->district}},
                                        {{$company->state}},{{$company->contry}},{{$company->email}},
                                        {{$company->mobile}},{{$company->phone}},
                                        {{$company->mysql_host}},{{$company->mysql_database}},
                                        {{$company->mysql_username}},{{$company->mysql_password}}">
                            </button>
                            <button class="delete-modal btn fa fa-trash"
                                data-info="{{$company->id}},{{$company->name}},{{$company->zipcode}},
                                        {{$company->address1}},{{$company->address2}},{{$company->district}},
                                        {{$company->state}},{{$company->contry}},{{$company->email}},
                                        {{$company->mobile}},{{$company->phone}},
                                        {{$company->mysql_host}},{{$company->mysql_database}},
                                        {{$company->mysql_username}},{{$company->mysql_password}}">
                                
                            </button>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
               </table>
           </div>
       </div>
    </div>
    @include('admin.company.company-modal')
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('#table1').dataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : true
        });
    });

    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        fillmodalData(stuff)
        $('#myModal').modal('show');
    });

    function fillmodalData(details){
        $('#id').val(details[0]);
        $('#name').val(details[1]);
        $('#email').val(details[2]);

    }

    $('.modal-footer').on('click', '.edit', function() {
        $.ajax({
            type: 'post',
            url: '/editItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id").val(),
                'name': $('#name').val(),
            },
            success: function(data) {
                if (data.errors){
                    $('#myModal').modal('show');
                    if(data.errors.fname) {
                        $('.name_error').removeClass('hidden');
                        $('.name_error').text("Name can't be empty !");
                    }
                    // if(data.errors.email) {
                    //     $('.email_error').removeClass('hidden');
                    //     $('.email_error').text("Email must be a valid one !");
                    // }
                    // // if(data.errors.country) {
                    //     $('.country_error').removeClass('hidden');
                    //     $('.country_error').text("Country must be a valid one !");
                    // }
                    // if(data.errors.salary) {
                    //     $('.salary_error').removeClass('hidden');
                    //     $('.salary_error').text("Salary must be a valid format ! (ex: #.##)");
                    // }
                }
                else {
                       
                    $('.error').addClass('hidden');
                    $('.item' + data.id).replaceWith(
                        "<tr class='item" + data.id + "'><td>" 
                        + data.id       + "</td><td>" 
                        + data.name     + "</td><td>" 
                        + data.email    + "</td><td>" 
                        + "<button class='edit-modal btn btn-info' data-info='" 
                        + data.id       +","
                        +data.name      +","
                        +data.email     +","
                        +"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" 
                        + data.id       +","
                        + data.name     +","
                        +data.email     +","
                        +"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>"
                    );
                }}
        });
    });
    $(document).on('click', '.delete-modal', function() {
        $('#footer_action_button').text(" Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        var stuff = $(this).data('info').split(',');
        $('.did').text(stuff[0]);
        $('.dname').html(stuff[1] +" "+stuff[2]);
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'post',
            url: '/deleteItem',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.did').text()
            },
            success: function(data) {
                $('.item' + $('.did').text()).remove();
            }
        });
    });
</script>
@stop

