@php
	$currentUrl = url()->current();
@endphp

<link href="{{asset('')}}assets/icons/font-awesome/css/font-awesome.css" rel="stylesheet">
{{-- <link href="{{asset('vendor/nguyendachuy-menu/style.css')}}" rel="stylesheet"> --}}

<div id="nguyen-huy" class="mt-2 mb-2 card">
	<div class="card-header">
		<form method="GET" action="{{ $currentUrl }}" class="form-inline">
			<label for="email" class="mr-sm-2">Select the menu you want to edit: </label>
			{!! Menu::select('menu', $menulist, ['class' => 'form-control']) !!}
			<button type="submit" class="btn btn-primary btn-sm ms-2">Submit</button>
            {{-- <span class="ms-3">or <a href="{{ $currentUrl }}?action=edit&menu=0">Create New Menu</a></span> --}}
		</form>
	</div>

	<div class="card-body">
		<input type="hidden" id="idmenu" value="{{$indmenu->id ?? null}}"/>
		<div class="row">
			<div class="col-md-4">
				@include('nguyendachuy-menu::partials.left')
			</div>
			<div class="col-md-8">
				@include('nguyendachuy-menu::partials.right')
			</div>
		</div>
	</div>

	<div class="ajax-loader" id="ajax_loader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
	</div>
</div>
