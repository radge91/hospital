<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control_producto extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Producto_model");
	}

	public function index(){
		$this->load->view('bodega/header');
		$this->load->view("bodega/nav");
		$datoscorrelativo['arrayCorrelativo'] = $this->Producto_model->get_correlativo();
		$this->load->view("bodega/vista_producto/view_producto", $datoscorrelativo);
		$this->load->view("bodega/vista_producto/footer2");
	}

	public function mostrar()
	{	
		//valor a Buscar
		$buscar = $this->input->post("buscar");
		$numeropagina = $this->input->post("nropagina");
		$cantidad = $this->input->post("cantidad");
		$combobuscar= $this->input->post("valorcombos");
		$inicio = ($numeropagina -1)*$cantidad;
		$data = array(
			"obtener" => $this->Producto_model->buscar($buscar,$inicio,$cantidad,$combobuscar),
			"totalregistros" => count($this->Producto_model->buscar($buscar)),
			"cantidad" =>$cantidad
			
		);
		echo json_encode($data);
	}

function validar(){
		if ($this->input->is_ajax_request()) {
			$rutsele = $this->input->post("id");
			if($this->Producto_model->validar($rutsele) == true)
				echo "Rut existe";
			else
				echo "rut no existe";
			
		}
		else
		{
			show_404();
		}
	}

function obtenercorrelativo(){

			if ($this->input->is_ajax_request()) {
			$codsele = $this->input->post("cod");
         $data = array(
			"obtener" => $this->Producto_model->obtenercorrelativo($codsele)
         	);
            echo json_encode($data);
		}
	}
	
function guardar() {
		//El metodo is_ajax_request() de la libreria input permite verificar
		//si se esta accediendo mediante el metodo AJAX 
		if ($this->input->is_ajax_request()) {

			$codigo = $this->input->post("codigo");
			$ultimocorrelativo = $this->input->post("ultimocorrelativo");
			$codbarra = $this->input->post("codigobarra");
			$codbodega = $this->input->post("combocorrelativo");
			$nombre = $this->input->post("nombre");
			$cantidad = $this->input->post("cantidad");
			$precio = $this->input->post("precio");
            $unidad = $this->input->post("seleccion");
            $stockcri = $this->input->post("stockcri");
            $stockmin = $this->input->post("stockmin");
            $stockmax = $this->input->post("stockmax");

            $this->form_validation->set_rules('codigo','Codigo','required|min_length[1]|max_length[10]');
			$this->form_validation->set_rules('codigobarra','Codigo Barra','required|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('combocorrelativo','Correlativo','required|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('nombre','Nombre','required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('cantidad','Cantidad','required|min_length[1]|max_length[50]|numeric');
			$this->form_validation->set_rules('precio','Precio','required|min_length[1]|max_length[50]|numeric');
			$this->form_validation->set_rules('seleccion','Unidad','required|min_length[1]|max_length[50]');
			$this->form_validation->set_rules('stockcri','Stock Critico','required|min_length[1]|max_length[50]|numeric');
			$this->form_validation->set_rules('stockmin','Stock Minimo','required|min_length[1]|max_length[50]|numeric');
			$this->form_validation->set_rules('stockmax','Stock Maximo','required|min_length[1]|max_length[50]|numeric');

       if ($this->form_validation->run() === TRUE) {
   			$datos = array(
				"cod_interno_prod" => $codigo,
				"codigo_barra" => $codbarra,
				"cod_bodega" => $codbodega,
				"nombre" => $nombre,
				"cantidad" => $cantidad,
				"precio" => $precio,
				"unidad_medida" => $unidad,
				"stock_critico" => $stockcri,
				"stock_minimo" => $stockmin,
				"stock_maximo" => $stockmax
				);
   			$datosactualizar = array(
				"ultimo_codigo" => $ultimocorrelativo
				
				);
		if($this->Producto_model->guardar($datos)==true){
         $this->Producto_model->actualizarcorrelativo($codbodega,$datosactualizar);
				echo "Registro Guardado";
			}else{
				echo "No se pudo guardar los datos";
			}
	}else
	{
				echo validation_errors('<li>','</li>');
	}
			
		}
		else
		{
			show_404();
		}
}

function actualizar(){
	
		if ($this->input->is_ajax_request()) {

			$rutselect = $this->input->post("selecrut");
			$nombres = $this->input->post("selecnombre");
			$razon = $this->input->post("selecrazon");
			$direccion= $this->input->post("selecdireccion");
			$telefono = $this->input->post("selectelefono");
			$correo = $this->input->post("seleccorreo");

			$this->form_validation->set_rules('selecnombre','Nombre','required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('selecrazon','Razon Social','required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('selecdireccion','Direccion','required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('selectelefono','Telefono','required|min_length[3]|max_length[50]|numeric');
			$this->form_validation->set_rules('seleccorreo','Correo','required|min_length[3]|max_length[50]|valid_email');
		
		if ($this->form_validation->run() === TRUE) {
	
			$datos = array(
				"nombre_proveedor" => $nombres,
				"razon_social" => $razon,
				"direccion" => $direccion,
		        "telefono" => $telefono,
		        "correo" => $correo,
				);
		
			if($this->Producto_model->actualizar($rutselect,$datos) == true)
				echo "Registro Actualizado";
			else
				echo "Error al Actualizar";
			
			}else
	{
				echo validation_errors('<li>','</li>');
	}
			
		}
		else
		{
			show_404();
		}
}


function editando() {

		if ($this->input->is_ajax_request()) {
			$rutsele = $this->input->post("id");
         $data = array(
			"obtener" => $this->Producto_model->editando($rutsele)
         	);
            echo json_encode($data);
		}

     
			
	}


function eliminar() {
		if ($this->input->is_ajax_request()) {

			$mipost = $this->input->post("micodigo");

			if($this->Producto_model->eliminar($mipost) == true)
				echo "Registro Eliminado";
			else
				echo "No se pudo eliminar los datos";
			
		}
		else
		{
			show_404();
		}
	}




} 