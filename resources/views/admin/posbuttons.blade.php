<h5 class="pos-label">WASHERS</h5>
@foreach($washers->chunk(4) as $chunk)
    <div class="row pad">
      @foreach($chunk as $washer)
        <div class="col-lg-3 ">
          <div class="btn btn-sm btn-info full pos-button healthy-button" data-id="{{$washer->product_id}}" data-description="{{$washer->product_name}}" data-price="{{$washer->price}}" data-memprice="{{$washer->member_price}}" data-qty="{{$washer->product_qty}}">
            {{str_limit($washer->product_name,15)}}
          </div>
        </div>
      @endforeach
    </div>
@endforeach 

<h5 class="pos-label">DRYERS</h5>
@foreach($dryers->chunk(4) as $chunk)
    <div class="row pad">
      @foreach($chunk as $dryer)
        <div class="col-lg-3 ">
          <div class="btn btn-sm btn-info full pos-button dryer healthy-button" data-id="{{$dryer->product_id}}" data-description="{{$dryer->product_name}}" data-price="{{$dryer->price}}" data-memprice="{{$dryer->member_price}}" data-qty="{{$dryer->product_qty}}">
            {{str_limit($dryer->product_name,15)}}
          </div>
        </div>
      @endforeach
    </div>
@endforeach 
<br>