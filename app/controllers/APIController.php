<?php 
namespace Controller;

use App\Models\Appointment;
use App\Models\AppointmentsDetails;
use App\Models\Service;

class APIController {

    public static function index() {
        $servicio = Service::findAll();
        echo json_encode($servicio);
    }

    public static function guardar() {
        //Almacena la Cita y devuelve el ID
        $cita = new Appointment($_POST);
        $resultado = $cita->save();
        $idCita = $resultado['id'];

        //Almacena la Cita y el Servicio
        $idServicios = explode(",", $_POST['servicios']);
        foreach ($idServicios as $idservicio) {
            $args = [
                'citasId' => $idCita,
                'servicioId' => $idservicio
            ];
            $citaServicio = new AppointmentsDetails($args);
            $citaServicio->save();
        }

        echo json_encode(['resultado' => $resultado]);
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Appointment::findById($id);
            $cita->eliminar();

            header('Location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}