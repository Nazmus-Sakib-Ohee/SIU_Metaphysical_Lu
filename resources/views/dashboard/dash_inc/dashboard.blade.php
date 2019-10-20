<br>
<br>

<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
      
                        <div class="col-xl-4 col-md-6">
                            <div class="card social-card bg-simple-c-blue">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <i class="feather icon-users f-34 text-c-blue social-icon"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="m-b-0">Users</h6>
                                            <p>{{$userCount}} valid users</p>
                                            <p class="m-b-0">Total number of users</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('users.all')}}" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card social-card bg-simple-c-pink">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <i class="icon-pin f-34 text-c-pink social-icon"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="m-b-0">All Ideas</h6>
                                            <p>{{$totalIdea}} Ideas</p>
                                            <p class="m-b-0">Total number of Ideas</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('idea.all')}}" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card social-card bg-simple-c-green">
                                <div class="card-block">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <i class="icon-equalizer f-34 text-c-green social-icon"></i>
                                        </div>
                                        <div class="col">
                                            <h6 class="m-b-0">User Roles</h6>
                                            <p>{{$RoleCount}} roles</p>
                                            <p class="m-b-0">Total number of roles</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{route('roles.all')}}" class="download-icon"><i class="feather icon-arrow-down"></i></a>
                            </div>
                        </div>
                     
                    </div>



       <div align="right"  >
        <p style="margin-left: 760px;margin-top: 12px ; font-size: 20px ;margin-top:10px"> Select Year</p>
    <select id="mySelect"style="
  display: inline-block;
  height: 30px;
  width: 100px;
  outline: none;
  color: #74646e;
  border: 1px solid #C8BFC4;
  border-radius: 4px;
  box-shadow: inset 1px 1px 2px #ddd8dc;
  background: #fff;
" onchange="myFunction(this.value)" >
      @php
      $year1=date('Y');
      @endphp
    @for($i=$year1;$i>$year1-10; $i--)
     <option style="font-size: 20px;" value="{{$i}}" @if($i==$year) {{"selected"}} @endif >{{$i}}</option>
    @endfor

</select>
 </div>
 <br>
<script>
function myFunction(val) {
            if(val){
               window.location.href = "{{route('dashboard')}}"+"/"+val;
            }else{
                location.reload();

            }
}
</script>


      <div class="container-fluid">



 <script>

window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    text: "Idea Analytics ,{{$year}}"
  },
  axisY :{
    includeZero: false,
    prefix: ""
  },
  toolTip: {
    shared: true
  },
  legend: {
    fontSize: 13
  },
  data: [


  {
    type: "splineArea",
    showInLegend: true,
    name: "New",
    yValueFormatString: "",
    dataPoints: [

    @foreach($ideaAnalyticsNew as $key)

    { x: new Date({{$key['year']}}, {{$key['month']-1}}), y: {{$key['amount']}}},
    @endforeach

    ]
  },

  {
    type: "splineArea",
    showInLegend: true,
    yValueFormatString: "",
    name: "In Process",
    dataPoints: [
    @foreach($ideaAnalyticsInProcess as $key)

    { x: new Date({{$key['year']}}, {{$key['month']-1}}), y: {{$key['amount']}}},
    @endforeach

    ]
  },
  {
    type: "splineArea",
    showInLegend: true,
    yValueFormatString: "",
    name: "On Hold",
    dataPoints: [
    @foreach($ideaAnalyticsOnHold as $key)

    { x: new Date({{$key['year']}}, {{$key['month']-1}}), y: {{$key['amount']}}},
    @endforeach

    ]
  },
  {
    type: "splineArea",
    yValueFormatString: "",
    name: "Completed",
    showInLegend: true,
    dataPoints: [
    @foreach($ideaAnalyticsCompleted as $key)

    { x: new Date({{$key['year']}}, {{$key['month']-1}}), y: {{$key['amount']}}},
    @endforeach

    ]
  },
  ]
});
chart.render();

}
</script>
<div id="chartContainer" class="container-fluid" style="height: 300px; width: 100%;"></div>
         </div>
                </div>
            </div>
            <div id="styleSelector">
            </div>
        </div>
    </div>
</div>