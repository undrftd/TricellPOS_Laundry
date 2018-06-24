@extends('layout')

@section('title')
TIMESHEET
@endsection

@section('css')
{{ asset('imports/css/members.css') }}
@endsection

@section('content')

</br>
<div class="container">
<!---title inventory-->
<h3 class="title">Timesheet</h3>
</br>
<hr>
  <!--end of members nav---->
<!---content of tabs start-->
  <div class="row">
    <div class="col-md-8">
        <a href="/timesheet/export/" class="btn btn-outline-info add-staff-btn">Export to CSV</a>
    </div>
    <div class="col-md-4">
    <form class="form ml-auto" action="/timesheet/filter" method="GET">
      <div class="input-group">
          <input class="form-control" name="date_filter" type="text" placeholder="Filter by Date" aria-label="Search" style="padding-left: 20px; border-radius: 40px;" id="date_filter" autocomplete="off">
          <div class="input-group-addon" style="margin-left: -50px; z-index: 3; border-radius: 40px; background-color: transparent; border:none;">
            <button class="btn btn-outline-info btn-sm" type="submit" style="border-radius: 100px;" id="search-btn"><i class="material-icons">search</i></button>
          </div>
      </div>
    </form>
  </div>
  </div>

  @if((!empty($date_start) && !empty($date_end)) && ($date_start != $date_end))
      @if($totalcount > 7)
        <center><p> Showing {{$count}} out of {{$totalcount}} results
          from <b>{{date('F d, Y', strtotime($date_start))}}</b> until <b>{{date('F d, Y', strtotime($date_end))}} </b> </p></center>
      @else
        <center><p> Showing {{$count}}
        @if($count > 1 || $count == 0)
          {{'results'}}
        @else
          {{'result'}}
        @endif
          from <b>{{date('F d, Y', strtotime($date_start))}}</b> until <b>{{date('F d, Y', strtotime($date_end))}} </b> </p></center>
      @endif
  @elseif((!empty($date_start) && !empty($date_end)) && ($date_start == $date_end))
      @if($totalcount > 7)
        <center><p> Showing {{$count}} out of {{$totalcount}} results
          for <b>{{date('F d, Y', strtotime($date_start))}}</b> </p></center>
      @else
        <center><p> Showing {{$count}}
        @if($count > 1 || $count == 0)
          {{'results'}}
        @else
          {{'result'}}
        @endif
          for <b>{{date('F d, Y', strtotime($date_start))}}</b> </p></center>
      @endif  
  @endif

  <table class="table table-hover">
    @csrf
      <thead class ="th_css">
        <tr>
          <th scope="col">Date</th>
          <th scope="col">ID Number</th>
          <th scope="col">Username</th>
          <th scope="col">Name</th>
          <th scope="col">Time In</th>
          <th scope="col">Time Out</th>
        </tr>
      </thead>
      <tbody class="td_class">
        @foreach($employees as $employee)
        <tr>
          <td class="td-center"><b>{{ date('F d, Y', strtotime($employee->time_in)) }}</b></td>
          <td class="td-center">{{ $employee->user->card_number }}</td>
          <td class="td-center">{{ $employee->user->username }}</td>
          <td class="td-center">{{ $employee->user->firstname . " " . $employee->user->lastname }}</td>
          <td class="td-center">{{ date('h:i:s A', strtotime($employee->time_in)) }}</td>
          <td class="td-center">
            @if(empty($employee->time_out))
              {{ 'Currently in'}}
            @else
              {{ date('h:i:s A', strtotime($employee->time_out)) }}
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{$employees->links()}}
  </div>

  <script type="text/javascript">
  $('input[name="date_filter"]').daterangepicker({
    autoUpdateInput: false,
    opens: 'center',
    locale: {
        cancelLabel: 'Clear'
    }
  });

  $('input[name="date_filter"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
  });

  $('input[name="date_filter"]').on('cancel.daterangepicker', function(ev, picker) {
      $(this).val('');
  });
  </script>
@endsection
