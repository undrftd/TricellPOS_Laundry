@foreach($items->chunk(4) as $chunk)
    <div class="row pad">
      @foreach($chunk as $item)
        <div class="col-lg-3 ">
          <div class="btn btn-sm btn-info full pos-button healthy-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
          </div>
        </div>
      @endforeach
    </div>
@endforeach 
<br>