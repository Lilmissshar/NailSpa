@if ($errors->any())
	@section('styles')
		<style>
			.alert-fixed{
				position: absolute;
		    top: 100px;
		    z-index: 99;
		    left: 24%;
			}
		</style>
	@endsection
	<div class="row justify-content-end">
		<div class="col-md-6 alert-fixed">
			<div class="alert alert-danger">
				<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
					<i class="nc-icon nc-simple-remove"></i>
				</button>
				<span>{{ $errors->first() }}</span>
			</div>
		</div>
	</div>
@endif

@if (session('success'))
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-md-12 alert-fixed">
				<div class="alert alert-success">
					<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
						<i class="nc-icon nc-simple-remove"></i>
					</button>
					<span>{{ session('success') }}</span>
				</div>
			</div>
		</div>
	</div>
@endif

@if (session('error'))
	<div class="container">
		<div class="row justify-content-end">
			<div class="col-md-12 alert-fixed">
				<div class="alert alert-danger">
					<button type="button" aria-hidden="true" class="close" data-dismiss="alert">
						<i class="nc-icon nc-simple-remove"></i>
					</button>
					<span>{{ session('error') }}</span>
				</div>
			</div>
		</div>
	</div>
@endif
