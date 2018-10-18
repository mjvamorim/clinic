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
                    <span class="hidden did"></span>
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
		var stuff = $(this).data('info');
		for(var key in stuff) {
			$('#'+key).val(stuff[key]);
		}
		$('#myModal').modal('show');
    });


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
                    if(data.errors.name) {
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
        var stuff = $(this).data('info');
        $('.did').text(stuff["id"]);
        $('.dname').html(stuff["name"]);
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

