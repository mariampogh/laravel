@extends('layouts.app')

@section('content')
	<div class="container-fluid" style="overflow: hidden;">
		@include('admin.leftMenu')
	  
        <canvas id="income" class="col-5 float-left" ></canvas>
        <script>

		var today = new Date();

		var aMonth = today.getMonth();
		var months= [], i;
		var month = new Array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
		for (i=0; i<12; i++) {
		 months.push(month[aMonth]);
		 aMonth--;
		 if (aMonth < 0) {
		  aMonth = 11;
		 }
		}

            var barData = {
                labels : months.reverse(),
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : "<?php  for($i= 0; $i<12;$i++){echo $userPerMonth[$i];}?>"
                    },
                ]
            }
          
            var income = document.getElementById("income").getContext("2d");
       
            new Chart(income).Bar(barData);
        </script>
    </div>

@endsection