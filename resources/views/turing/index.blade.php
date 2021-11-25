@extends('layouts.app')
@section('content')
{{-- Grafico --}}
<script type="text/javascript" src="https://unpkg.com/vis-network/dist/vis-network.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://unpkg.com/vis-network/dist/vis-network.min.css" />
<style type="text/css">
	#mynetwork {
		width: 100%;
		height: 400px;
		border: 1px solid lightgray;
	}
</style>

<div class="container">
	<div class="row">
		<div class="col-12 col-md-6">
			<h3>Movimientos de la cinta</h3>
			@foreach($graficas as $grafica)

				<label for="file" class="form-label h4 text-muted">Estado: {{$grafica["estado_actual"]}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				@for ($i = 0; $i < count($grafica["cinta"]); $i++)
					<label for="file" class="form-label h4" @if($grafica["posicion"]==$i) style="background-color: pink; border: solid; padding: 5px" @else style="border: solid; padding: 5px" @endif > {{$grafica["cinta"][$i]}} </label>
				@endfor
				<br>
			@endforeach			
		</div>	
		<div class="col-12 col-md-6">
			<h3>Diagrama de Transiciones</h3>
			<div id="mynetwork" >
	<div class="vis-network" tabindex="0" style="position: relative; overflow: hidden; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 100%; height: 100%;">

	</div>
</div>

			
		</div>
	</div>
	<hr>
	
</div>

<script type="text/javascript">
	/*Crea los nodos*/
	var nodes = new vis.DataSet([
  	<?php foreach ($estados as $estado): ?>
  		{ id: <?php echo $estado?>,
  			label: "<?php if($estado ==1)echo $estado.' Inicial'; else echo $estado ?>",
  			title: "<?php echo $estado ?>",
  			},
  		<?php endforeach ?>
  		]);

  // crea un arreglo con los arcos
  var edges = new vis.DataSet([
  	<?php foreach ($relaciones as $relacion): ?>
  		{ from: <?php echo $relacion["estado_anterior"]; ?>, to: <?php echo $relacion["estado_actual"];  ?>,
  		arrows: "to",
  	 },
  	<?php endforeach ?>
  	]);

  // create a network
  var container = document.getElementById("mynetwork");
  var data = {
  	nodes: nodes,
  	edges: edges
  };
  var options = {};
  var network = new vis.Network(container, data, options);


</script>


@endsection