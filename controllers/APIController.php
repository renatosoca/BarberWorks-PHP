<?php 
namespace Controller;

use Model\Cita;
use Model\CitaServicio;
use Model\Servicio;

class APIController {

    public static function index() {
        $servicio = Servicio::all();
        echo json_encode($servicio);
    }

    public static function guardar() {
        //Almacena la Cita y devuelve el ID
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $idCita = $resultado['id'];

        //Almacena la Cita y el Servicio
        $idServicios = explode(",", $_POST['servicios']);
        foreach ($idServicios as $idservicio) {
            $args = [
                'citasId' => $idCita,
                'servicioId' => $idservicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();

            header('Location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}