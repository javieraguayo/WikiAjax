<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Producto extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('producto_model', 'Model');
        $this->load->library("funciones");

    }

    public function index()
    {
        $data['contenido'] = "Estandar/index";
        $this->load->view('Home/home', $data);
    }

    public function getViewResponse()
    {

        $data = array();

        $data['Param1'] = $this->input->post('Param1');
        $data['Param2'] = $this->input->post('Param2');
        $data['Param3'] = $this->input->post('Param3');

        $Where['1']           = 1;
        $data['getProductos'] = $this->Model->_sql('productos', $Where, '');

        $View = $this->load->view('Estandar/table', $data, true); //Encapsular toda la Vista en una variable

        //Forma de devolver parametros (vistas, obj, echo) desde controlador a JS(AJAX)
        $this->output
            ->set_content_type('application/json')
            ->set_output(
                json_encode(array(
                    'success' => true,
                    'ViewSet' => $View,

                ))
            );
    }

    
    public function SaveDatos(){
            $opc = $this->input->post('opcion');
            $token = $this->input->post('token');
            $data=array();
            if($opc=='1'){
                $Where="";
                $data['token']=$this->funciones->RandomCaracteres(8);

            }else{
                $Where['productos.token']=$token;
            }
            //Armando Array de Datos
            
            $data['NombreProducto']=$this->input->post('nombre_producto');

            //id de input 
            //#Guardando Datos'
            $saveDatos=$this->Model->_SaveData('productos',$data,$Where,$opc,$token);

        }

    public function lista_eliminar(){
            $Where['1']=1;
            $data["productos"]=$this->Model->_sql('productos',$Where,'');//variable del for
            $this->load->view('Estandar/table',$data);//envio datos a la vista
    }

    public function eliminar(){
            $data=array();//sacar

            $Where['token']=$this->input->post("token");
            $elimina=$this->Model->_Delete('productos',$Where,'');
    }

   public function Modificar() {

        $token=$this->uri->segment("3");
        $datos['producto']= $this->Model->CargarDatos($token);

        $this->load->view('Estandar/table',$datos);

    }  

    public function editar(){

        $token = $this->input->post('token');               
        
        $data=array();
        $data['token']=$this->input->post('token');
        $data['nombre'] = $this->input->post("nombre");
        

        $agregar=$this->Model->editar('productos',$data,$token);
        redirect('Estandar/table');


    }
                        
            


}

/* End of file Producto.php */
/* Location: ./application/controllers/Producto.php */
