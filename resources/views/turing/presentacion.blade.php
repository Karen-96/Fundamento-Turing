@extends('layouts.app')
@section('content')
<div class="container">
	
	<div class="card" style="border-left: 6px solid black;" >
		<div class="card-header" style="background-color: #BBC6A9;">
			<label class="display-2 text-center"> Máquina de Turing		
			</label>
		</div>
		<div class="card-body">
			<h5 class="card-title">Bienvenidos !!</h5>
			<p class="card-text">Para comenzar presione el botón configuración para cargar las reglas necesarias.</p>
			<a href="{{route('turing.configuracion')}}" class="btn btn-primary">Configuración</a>
		</div>
	</div>
</div>
@endsection