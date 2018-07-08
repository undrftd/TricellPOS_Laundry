@foreach($products->chunk(4) as $chunk)
  @if($chunk->count() == 4) 
    <div class="row pad">
      @foreach($chunk as $product)
        <div class="col-lg-3 ">
          <div class="btn btn-sm btn-info full pos-button <?php if($product->product_id <=24 && $product->product_id >=13) { echo "dryer"; }else if($product->product_id > 24) { echo "product"; } ?> healthy-button" data-id="{{$product->product_id}}" data-description="{{$product->product_name}}" data-price="{{$product->price}}" data-memprice="{{$product->member_price}}" data-qty="{{$product->product_qty}}">
            {{str_limit($product->product_name,15)}}
          </div>
        </div>
      @endforeach
    </div>
  @elseif($chunk->count() == 3) 
    <div class="row pad">
      @foreach($chunk as $product)
        <div class="col-lg-4">
          <div class="btn btn-sm btn-info full pos-button <?php if($product->product_id <=24 && $product->product_id >=13) { echo "dryer"; }else if($product->product_id > 24) {echo "product"; } ?> healthy-button" data-id="{{$product->product_id}}" data-description="{{$product->product_name}}" data-price="{{$product->price}}" data-memprice="{{$product->member_price}}" data-qty="{{$product->product_qty}}">
            {{str_limit($product->product_name,15)}}
          </div>
        </div>
      @endforeach
    </div>
  @elseif($chunk->count() == 2) 
    <div class="row pad">
      @foreach($chunk as $product)
        <div class="col-lg-6">
          <div class="btn btn-sm btn-info full pos-button <?php if($product->product_id <=24 && $product->product_id >=13) { echo "dryer"; }else if($product->product_id > 24) { echo "product"; } ?> healthy-button" data-id="{{$product->product_id}}" data-description="{{$product->product_name}}" data-price="{{$product->price}}" data-memprice="{{$product->member_price}}" data-qty="{{$product->product_qty}}">
            {{str_limit($product->product_name,15)}}
          </div>
        </div>
      @endforeach
    </div>
  @elseif($chunk->count() == 1) 
    <div class="row pad">
      @foreach($chunk as $product)
        <div class="col-lg-12">
          <div class="btn btn-sm btn-info full pos-button <?php if($product->product_id <=24 && $product->product_id >=13) { echo "dryer"; }else if($product->product_id > 24) {echo "product"; } ?> healthy-button" data-id="{{$product->product_id}}" data-description="{{$product->product_name}}" data-price="{{$product->price}}" data-memprice="{{$product->member_price}}" data-qty="{{$product->product_qty}}">
            {{str_limit($product->product_name,15)}}
          </div>
        </div>
      @endforeach
    </div>
  @endif
@endforeach 

<br>
{{$products->links()}}