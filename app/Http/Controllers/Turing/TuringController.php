<?php

namespace App\Http\Controllers\Turing;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Exception;

class TuringController extends Controller
{
	public function presentacion(){
		return view('turing.presentacion');
	}

	// public function index(){
	//     return view('turing.index');
	// }

	public function configuracion(){
		return view('turing.configuracion.index');
	}

	public function configuracionGuardar(Request $request){

		/*Leer el archivo csv (Falta)*/
		// $file = $request->file('file');
		// return $request;

		/*Traigo lo que el usuario ingreso en pantalla a las variables*/
		$cinta= $request->cinta;
		$estado_inicial=$request->estadoInicial;
		$estado_final=$request->estadoFinal;
		$simbolo = $request->simbolo;
		$estado_actual= $estado_inicial;
		$posicion = 0; #posicion si

		/*Variables auxiliares*/
		$estado_anterior = 0;
		$aux=[];
		$graficas = [];
		$salir = true;


		//coloca el simbolo final
		//$cinta = $cinta.$simbolo;
		// return $cinta;

		/*
		Como no termine de implementar las reglas de transicion en un cvs y leerlo 
		lo cargo a mano por el momento. Lo defini de la siguiente forma ejemplo:

		(Estado) (valor) | (Nuevo Valor) (Direccion)       (Nuevo Estado)
			1       0            x           r(derecha)         2
		*/

			/*Ejemplo 1: Cadenas que acepta de la forma 0^n1^n.^ (0011)*/
			$reglas = [
				1 =>[
					'0' =>['x','r',2],
					'y' =>['y','r',4],
				],
				2 =>[
					'0' =>['0','r',2],
					'1' =>['y','l',3],
					'y' =>['y','r',2],
				],
				3 =>[
					'0'=>['0','l',3],
					'x'=>['x','r',1],
					'y'=>['y','l',3],

				],
				4 =>[
					'y'=>['y','r',4],
					'b'=>['b','r',5],
				],
			];
			
			/*
			Ejemplo 2:
			cinta: a,b,c,d* Acepta con el simbolo * */

			// $reglas = [
			// 	1=>[
			// 		'a'=>['a','r',1],
			// 		'b'=>['b','r',1],
			// 		'c'=>['c','r',1],
			// 		'd'=>['d','r',1],
			// 		'*'=>['d','r',2],

			// 	],
			// ];

			/* Recorro la cinta y busco en las reglas el elemento de la cinta, y muevo el cabezal dependiendo
			de lo que esta defino en las reglas */
			while ($salir){
			// echo nl2br(" \n");
			// echo ($estado_actual.'     ');

				/*Recorro los caracteres de la cinta */
		/*		for ($i=0; $i < strlen($cinta) ; $i++) { 
					if ($i==$posicion) {
						$cinta[$i];
						// echo '['.$cinta[$i].'] ';
					}else{
						$cinta[$i];
						// echo $cinta[$i].' ';
					}
				}*/

				/*Guardo los datos para llevar en pantalla los movimientos de la cinta*/
				$graficas[] = ["estado_actual"=>$estado_actual, "cinta"=>str_split($cinta), "posicion"=>$posicion, "estado_anterior"=> $estado_anterior];

			/*Pregunto si el estado_actual es igual final del estado, si es
			verdadero entonces sale del programa y muestra los datos*/
			if ($estado_actual == $estado_final) {
				$salir = false;
				break;
			}

			try{
				/* Traigo la regla que coincide con el elemento de la cinta */
				$aux = $reglas[$estado_actual][$cinta[$posicion]];
			} catch (Exception $e){
				// echo '['.$simbolo.']';
				/* Si surge un error, pone el simbolo al final de la cinta */
				/*$graficas[count($graficas)-1] = ["estado_actual"=>$estado_actual, "cinta"=>str_split($cinta.$simbolo), "posicion"=>$posicion, "estado_anterior"=> $estado_anterior];*/
				$salir = false;
			}
			

			/*Reescribe el simbolo en la cinta*/
			try{

				/* Reemplazo el nuevo caracter en la cinta */
				$cinta[$posicion] = $aux[0];

				/*Movimiento del cabezal de la cinta*/
				/* AUX => Regla que coincide con el elemento de la cinta (Linea 110) */
				/* Si el movimiento es hacia la derecha, se incrementa la posicion y si excede el tamaÃ±o de
				la cinta, se coloca un Simbolo al final*/
				if ($aux[1] == 'r') {
					if($posicion >= (strlen($cinta)-1)){
						$cinta = $cinta.$simbolo;
					}
					$posicion++;
				}else{
					/* Si el movimiento es hacia la izquierda, primero pregunto si es mayor a 0 y decremento la posicion, sino, aÃ±ado un simbolo al inicio de la cinta */
					if ($aux[1] == 'l') {
						if ($posicion > 0) {
							$posicion--;        
						}else{
							$cinta = $simbolo.$cinta;
						}
					}

				}

				/* Guardo el estado anterior para unir los nodos en la grafica */
				$estado_anterior = $estado_actual;
				/* Cambio mi estado actual por el nuevo estado */
				$estado_actual =$aux[2];
			}catch(Exception $e){

			}
		}

		/* Obtengo todos los estados de las reglas */
		$estados = [];
		foreach ($graficas as $grafica) {
			$estados[] = $grafica["estado_actual"];
		}
		/* Si hay estados repetidos, los elimino */
		$estados = array_unique($estados);


		/* Obtengo las relaciones "Estado_Anterior -> Estado_Actual" y quito las relaciones duplicadas para que en la grafica no se repitan */
		$relaciones = [];
		foreach ($graficas as $grafica) {
			$existe = false;
			foreach($relaciones as $relacion){
				if($relacion["estado_anterior"] == $grafica["estado_anterior"] && $relacion["estado_actual"] == $grafica["estado_actual"]){
					$existe = true;
				}
			}

			if (!$existe) {
				$relaciones[] = ["estado_anterior"=> $grafica["estado_anterior"], "estado_actual"=> $grafica["estado_actual"]];    
			}
			
		}

		return view('turing.index',compact('graficas', 'estados', 'relaciones', 'estado_inicial', 'estado_final'));
	}


}