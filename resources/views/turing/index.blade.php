@extends('layouts.app')
@section('content')

{{-- <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css"> --}}
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
			<h3><i class="fas fa-tape"></i> Movimientos de la cinta</h3>
			@foreach($graficas as $grafica)

			<label for="file" class="form-label h4 text-muted">Estado: {{$grafica["estado_actual"]}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
			@for ($i = 0; $i < count($grafica["cinta"]); $i++)
			<label for="file" class="form-label h4" @if($grafica["posicion"]==$i) style="background-color: pink; border: solid; padding: 5px" @else style="border: solid; padding: 5px" @endif > {{$grafica["cinta"][$i]}} </label>
			@endfor
			<br>
			@endforeach			
		</div>	
		<div class="col-12 col-md-6">
			<h3>Diagrama de Transiciones con la cinta</h3>
			<div id="mynetwork" >
				<div class="vis-network" tabindex="0" style="position: relative; overflow: hidden; touch-action: pan-y; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 100%; height: 100%;">

				</div>

			</div>
			<div class="py-2"></div>
			<div>

				<label class="h5"><i class="fas fa-circle text-danger"></i> Nodo Inicial</label>&nbsp;
				<label class="h5"><i class="fas fa-circle text-success"></i> Nodo Final</label>
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
			label: "<?php echo $estado ?>",
			title: "<?php echo $estado ?>",
			color: "<?php if($estado == $estado_inicial)echo '#FF333C'; elseif($estado == $estado_final)echo '#1AB812'; else echo '#334FFF';?>",
			font: {color: "white"},
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