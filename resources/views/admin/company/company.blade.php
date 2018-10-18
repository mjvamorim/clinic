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
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover table-bordered data-table" id="table1">
                   <thead>
                    <tr>
                        <th class="text-center">Actions</th>
                        @foreach ($showables as $col)
                            @if($col['show']=='true')
                                <th class="">{{ ucwords($col['title']) }}</th>
                            @endif
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($companies as $company)                        
                    {{ json_encode($company) }}
                    <tr>
                        <td class="text-center">
                            <button class="edit-modal btn fa fa-edit"
                                data-info="{{json_encode($company)}}">
                            </button>
                            <button class="delete-modal btn fa fa-trash"
                                data-info="{{json_encode($company)}}">  
                            </button>
                        </td>

                        {{-- Mostra os conteúdo da coleção --}}
                        @foreach ($company->getShowableFields() as $k => $v)
                        @if($v['show']=='true')
                        <td>{{$company[$v['name']]}}</td>
                        @endif
                        @endforeach

                    </tr>
                    @endforeach
                    </tbody>
               </table>
           </div>
       </div>
    </div>
    @include('admin.company.company-modal')
@stop

