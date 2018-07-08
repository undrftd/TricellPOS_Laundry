@foreach($products->chunk(4) as $chunk)
    <div class="row pad">
      @foreach($chunk as $product)
        <div class="col-lg-3 ">
          <div class="btn btn-sm btn-info full pos-button <?php if($product->product_id <=24 && $product->product_id >=13) { echo "dryer"; }else if($product->product_id > 24) { /* add your class here example: echo "product" */} ?> healthy-button" data-id="{{$product->product_id}}" data-description="{{$product->product_name}}" data-price="{{$product->price}}" data-memprice="{{$product->member_price}}" data-qty="{{$product->product_qty}}">
            {{str_limit($product->product_name,15)}}
          </div>
        </div>
      @endforeach
    </div>
@endforeach 

<br>
{{$products->links()}}