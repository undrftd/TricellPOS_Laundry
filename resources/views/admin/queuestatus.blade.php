<div class="container-fluid">
  
  <h6>WASHING MACHINE</h6> <br>
  <div class="row mx-auto">

      @foreach($washers as $washer)
        <div class="col">
          <h5><b>{{$loop->iteration}}</b></h5>
          @if($washer->switch != 0)
            <center><i class="material-icons laundry_icon laundry_icon_active">local_laundry_service</i></center>
            <p class="timer" id="timer{{$loop->iteration}}"></span>
          @else
            <center><i class="material-icons laundry_icon laundry_icon_inactive">local_laundry_service</i></center>
            <p class="timer">Available</p>
          @endif
        </div>
      @endforeach          
  </div> 
  <hr>
  <h6>DRYER</h6> <br>
  <div class="row mx-auto">
      @foreach($dryers as $dryer)
        <div class="col">
          <h5><b>{{$loop->iteration}}</b></h5>
          @if($dryer->switch != 0)
            <center><i class="material-icons laundry_icon laundry_icon_active">local_laundry_service</i></center>
            <p class="timer" id="timer{{$loop->iteration}}"></p>
          @else
            <center><i class="material-icons laundry_icon laundry_icon_inactive">local_laundry_service</i></center>
            <p class="timer">Available</p>
          @endif
        </div>
      @endforeach   
  </div>  

</div>