<div id="myModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" role="form">
					@foreach ($showables as $field)
					<div class="form-group">
						<label class="control-label col-sm-2" for="{{$field['name']}}">
							{{ucwords($field['title'])}}</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="{{$field['name']}}" 
								{{$field['type']=='id' ? 'disabled' : ''}} >
						</div>
					</div>
					<p class="{{$field['name']}}_error error text-center alert alert-danger hidden"></p>
		
					@endforeach
					
				</form>
				<div class="deleteContent">
                    Are you Sure you want to delete <b><span class="dname"></span></b> ? 
                    <span class="hidden id"></span>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn actionBtn" data-dismiss="modal">
						<span id="footer_action_button" class='glyphicon'> </span>
					</button>
					<button type="button" class="btn btn-warning" data-dismiss="modal">
						<span class='glyphicon glyphicon-remove'></span> Close
					</button>
				</div>
			</div>
		</div>
	</div>
</div>


@section('js')
<script>
    item=""; //Line Table's Content 
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
        $('#footer_action_button').text(" Save");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Company');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
		item = $(this).data('info');
		for(var key in item) {
			$('#'+key).val(item[key]);
		}
        $('.id').text(item["id"]);
		$('#myModal').modal('show');
    });


    $('.modal-footer').on('click', '.edit', function() {
        var data = {'_token': $('input[name=_token]').val()};
        for (var key in item) {
            //console.log(key, item[key]);
            data[key] = $('#'+key).val()
        }
        
        if ($('#id').val()) {
            method = 'put';
            url    = '/admin/company/'+ $('.id').text();
        }
        else { 
            method = 'post';
            url    = '/admin/company/';
        }

        $.ajax({
            type: method,
            url: url,
            dataType:'json',
            data: data,
            success: function(data) {
                if (data.errors){
                    if(data.errors.name) {
                        $('.name_error').removeClass('hidden');
                        $('.name_error').text(data.errors.name);
                    }
                    $('#myModal').modal('show');
                }
                else {                     
                    $('.error').addClass('hidden');
                    //window.location='/admin/company';
                }
            } 
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
        item = $(this).data('info');
		$('.id').text(item["id"]);
        $('.dname').html(item["name"]);
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.delete', function() {
        $.ajax({
            type: 'delete',
            url: '/admin/company/'+ $('.id').text(),
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.id').text()
            },
            success: function(data) {
                $('.item' + $('.id').text()).remove();
                //window.location='/admin/company';
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }  
        });
    });
</script>
@stop

