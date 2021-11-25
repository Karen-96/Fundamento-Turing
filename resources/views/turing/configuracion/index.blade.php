@extends('layouts.app')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-12 col-md-6">
			<h3>Configuración</h3>			
		</div>	
	</div>
	<hr>
	<form action="{{route('turing.import.excel')}}" method="post" enctype="multipart/form-data">
		@csrf
		<label for="file" class="form-label h4">Reglas de Transición </label>
		<input type="file" id="file" {{-- name="file" --}} class="form-control" aria-describedby="archivo">
		<div id="archivo" class="form-text">
			Ingrese un archivo excel unicamente.
		</div>
		<hr>
		<div class="row">
			<div class="col">
				<label for="file" class="form-label h4">Cinta </label>
				<input type="text" class="form-control" name="cinta" placeholder="">
				<div id="archivo" class="form-text">
					Inserta los elementos de la cinta 
				</div>
			</div>
			{{-- <div class="col">
				<label for="file" class="form-label h4">Posición </label>
				<input type="number" min="0" class="form-control" name="posicion" placeholder="">
				<div id="archivo" class="form-text">
					Ingrese la posicion de la cinta
				</div>
			</div> --}}
		</div>





		{{-- <label for="file" class="form-label h4">Cinta </label>
		<input type="cinta" id="cinta" name="cinta" class="form-control" aria-describedby="archivo" required>
		<div id="archivo" class="form-text">
			Inserta los elementos de la cinta 
		</div> --}}
		<hr>
		<div class="row">
			<div class="col">
				<label for="file" class="form-label h4">Estado Inicial </label>
				<input type="text" class="form-control" name="estadoInicial" placeholder="">
				<div id="archivo" class="form-text">
					Ingrese el estado inicial de la Máquina de Turing
				</div>
			</div>
			<div class="col">
				<label for="file" class="form-label h4">Estado Final </label>
				<input type="text" class="form-control" name="estadoFinal" placeholder="">
				<div id="archivo" class="form-text">
					Ingrese el estado valido y/o final de la Máquina de Turing
				</div>
			</div>
			<div class="col">
				<label for="file" class="form-label h4">Simbolo </label>
				<input type="text" class="form-control" name="simbolo" placeholder="">
				<div id="archivo" class="form-text">
					Ingrese simbolo blanco del alfabeto de la cinta
				</div>
			</div>
		</div>

		<div class="py-4"></div>
		<div class="d-grid gap-2 d-md-flex justify-content-md-end">
			<button type="submit" class="btn btn-primary">Ejecutar</button>
			<a href="{{route('turing.presentacion')}}" class="btn btn-primary" type="button">Atrás</a>
		</div>		
	</form>	
</div>	
@endsection