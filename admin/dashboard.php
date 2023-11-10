<?php
require_once "../db/pdo.php";
session_start();
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Pet Types</title>
<!--Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<link rel="stylesheet" href="../assets/css/login.css" type="text/css">

<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

<!--Icon -->
<link rel="icon" href="../assets/images/favicon.ico">
 
<script src="https://kit.fontawesome.com/8181027d18.js"crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">


</script>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"> </script>
<script type="text/javascript">
$(document).ready(function() {
$.ajax({
url : "jsondata.php",
dataType : "JSON",
success : function(result) {
google.charts.load('current', {

'packages' : [ 'corechart' ]
});
google.charts.setOnLoadCallback(function() {
drawChart(result);
});
}
});

function drawChart(result) {
var data = new google.visualization.DataTable();

data.addColumn('string', 'pet_name');
data.addColumn('number', 'species_id');

var dataArray = [];
$.each(result, function(i, obj) {
dataArray.push([ obj.pet_name, parseInt(obj.species_id) ]);
});
data.addRows(dataArray);
var piechart_options = {
title : 'Pie Chart: Pet name classified by species',
width : 400,
height : 300
};

var piechart = new google.visualization.PieChart(document
.getElementById('piechart_div'));
piechart.draw(data, piechart_options);
var barchart_options = {
title : 'Barchart: Pet name classified by species',
width : 400,
height : 300,
legend : 'true'
};
var barchart = new google.visualization.BarChart(document.getElementById('barchart_div'));

barchart.draw(data, barchart_options);



var linechart_options = {
title : 'Linechart: Pet name classified by species',
width : 400,
height : 300,
legend : 'true'
};

var linechart = new google.visualization.LineChart(document.getElementById('linechart_div'));

linechart.draw(data, linechart_options);
}





});



</script>
</head>
<body>
        
<!--Header-->
<?php include_once('../assets/includes/hadmin.php');?>

<!-- /Header -->


<div class="container-fluid mt-5">
<div class="row">
<main class="col-md-7 offset-md-1 py-5">
<div class="row mt-3">

<table class="columns">
<tr>
<td>
<div id="piechart_div" style="border: 1px solid #ccc"></div>
</td>
<td>
<div id="barchart_div" style="border: 1px solid #ccc"></div>
</td>
</tr>
<td>
<div id="linechart_div" style="border: 1px solid #ccc"></div>
</td>
</table>
</div>
</main>
</div>
</div>




<!-- Scripts --> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

</body>
</html>