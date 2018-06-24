@foreach($items->chunk(4) as $chunk)

  @if($chunk->count() == 4) 
    <div class="row pad">
      @foreach($chunk as $item)
        @if($item->product_qty <= $lowstock->low_stock && $item->product_qty > 0)
        <div class="col-lg-3 ">
          <div class="btn btn-sm btn-info full pos-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
           <span class="low_stock"> <br> Low Stock </span>
          </div>
        </div>
        @elseif($item->product_qty == 0)
          <div class="col-lg-3 ">
            <div class="btn btn-sm btn-light full pos-button disabled" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
              {{str_limit($item->product_name,15)}}
              <span> <br> No Stock </span>
            </div>
          </div>
        @else
        <div class="col-lg-3 ">
          <div class="btn btn-sm btn-info full pos-button healthy-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
          </div>
        </div>
        @endif
      @endforeach
    </div>
  @elseif($chunk->count() == 3) 
    <div class="row pad">
      @foreach($chunk as $item)
        @if($item->product_qty <= $lowstock->low_stock && $item->product_qty > 0)
        <div class="col-lg-4 ">
          <div class="btn btn-sm btn-info full pos-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
           <span class="low_stock"> <br> Low Stock </span>
          </div>
        </div>
        @elseif($item->product_qty == 0)
          <div class="col-lg-4 ">
            <div class="btn btn-sm btn-light full pos-button disabled" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
              {{str_limit($item->product_name,15)}}
              <span> <br> No Stock </span>
            </div>
          </div>
        @else
        <div class="col-lg-4 ">
          <div class="btn btn-sm btn-info full pos-button healthy-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
          </div>
        </div>
        @endif
      @endforeach
    </div>
  @elseif($chunk->count() == 2) 
    <div class="row pad">
      @foreach($chunk as $item)
        @if($item->product_qty <= $lowstock->low_stock && $item->product_qty > 0)
        <div class="col-lg-6 ">
          <div class="btn btn-sm btn-info full pos-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
           <span class="low_stock"> <br> Low Stock </span>
          </div>
        </div>
        @elseif($item->product_qty == 0)
          <div class="col-lg-6 ">
            <div class="btn btn-sm btn-light full pos-button disabled" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
              {{str_limit($item->product_name,15)}}
              <span> <br> No Stock </span>
            </div>
          </div>
        @else
        <div class="col-lg-6 ">
          <div class="btn btn-sm btn-info full pos-button healthy-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
          </div>
        </div>
        @endif
      @endforeach
    </div>
  @else
    <div class="row pad">
      @foreach($chunk as $item)
        @if($item->product_qty <= $lowstock->low_stock && $item->product_qty > 0)
        <div class="col-lg-12 ">
          <div class="btn btn-sm btn-info full pos-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
           <span class="low_stock"> <br> Low Stock </span>
          </div>
        </div>
        @elseif($item->product_qty == 0)
          <div class="col-lg-12 ">
            <div class="btn btn-sm btn-light full pos-button disabled" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
              {{str_limit($item->product_name,15)}}
              <span> <br> No Stock </span>
            </div>
          </div>
        @else
        <div class="col-lg-12 ">
          <div class="btn btn-sm btn-info full pos-button healthy-button" data-id="{{$item->product_id}}" data-description="{{$item->product_name}}" data-price="{{$item->price}}" data-memprice="{{$item->member_price}}" data-qty="{{$item->product_qty}}">
            {{str_limit($item->product_name,15)}}
          </div>
        </div>
        @endif
      @endforeach
    </div>
  @endif
@endforeach 
<br>
{{$items->links()}}