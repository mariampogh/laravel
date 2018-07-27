<div class="modal fade" id="delete" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h4 class="modal-title w-100 font-weight-bold">Delete?</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>	
			</div>
			<div class="modal-body">
	          	<form action="" method="post" class="confirm">
      		    	{!! method_field('delete') !!}
          		    {!! csrf_field() !!}
	              	<button type="submit" class="btn btn-danger">Yes</button>
	              	<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				</form> 
            </div>
		</div>
	</div>
</div>




		      