<div class="container-fluid">
	<div class="row">
		@if(count($washers) != 0)
			@foreach($washers as $washer)
				@for($i = 1; $i <= $washer->quantity; $i++)
					<div class="col mx-auto service">
						<h6><b>{{substr($washer->product->product_name,-1)}}</b></h6>
						<i class="material-icons laundry_icon_button2">local_laundry_service</i>
						<center><label class="switch switch_type1" role="switch">
							<input type="checkbox" class="switch__toggle" data-id="{{$washer->product_id}}" data-sales-id = "{{ $washer->sales_id }}" data-switch = "{{ $washer->product->switch }}"
							@php if($washer->product->switch != 0) { echo 'checked'; } @endphp
							>
							<span class="switch__label"></span>
						</label></center>
					</div>
				@endfor
			@endforeach
		@endif
	</div>
	@if(count($dryers) != 0 && count($washers) != 0 )
		<hr>
	@endif
	<div class="row">
		@if(count($dryers) != 0)
			@foreach($dryers as $dryer)
				@for($i = 1; $i <= $dryer->quantity; $i++)
					<div class="col mx-auto service">
						<h6><b>{{substr($dryer->product->product_name,-1)}}</b></h6>
						<i class="material-icons laundry_icon_button2">toys</i>
						<center><label class="switch switch_type1" role="switch">
							<input type="checkbox" class="switch__toggle" data-id="{{$dryer->product_id}}" data-sales-id = "{{ $dryer->sales_id }}" data-switch = "{{ $dryer->product->switch }}" @php if($dryer->product->switch != 0) { echo 'checked'; } @endphp>
							<span class="switch__label"></span>
						</label></center>
					</div>
				@endfor
			@endforeach
		@endif
	</div>
</div>