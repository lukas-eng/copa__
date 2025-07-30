<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Usuario;
use App\Models\manzana_servicio;
use App\Models\manzana;
use App\Models\Servicio;
use App\Models\Solicitud;

use Illuminate\Support\Facades\Hash;


class APIController extends Controller
{
    private function validateToken(Request $request)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['message' => 'El token no se ingresó'], 400);
        }

        $user = Usuario::where('token', $token)->first();

        if (!$user) {
            return response()->json(['message' => 'El token es incorrecto'], 401);
        }

        return $user;
    }
    
    //R E G I S T R O

        public function registrar(Request $request)
        {
            
            $usuario = new Usuario();
            $usuario->nombre = $request->nombre;
            $usuario->tipo_documento = $request->tipo_documento;
            $usuario->numero_documento = $request->numero_documento;
            $usuario->password = Hash::make($request->password);
            $usuario->rol = 'Usuario'; // fijo
            $usuario->id_manzana = $request->id_manzana;

            $usuario->save();

            return response()->json([
                'mensaje' => 'Usuario registrado correctamente',
                'usuario' => $usuario,
            ]);
        }


    //I N I C I O D E S E S I O N
    public function login(Request $request)
    {
        $request->validate([
            'numero_documento' => 'required',
            'password' => 'required',
        ]);

        $usuario = Usuario::where('numero_documento', $request->numero_documento)->first();

        if (!$usuario || !\Hash::check($request->password, $usuario->password)) {
            return response()->json(['mensaje' => 'Credenciales incorrectas'], 401);
        }

        return response()->json([
            'mensaje' => 'Inicio de sesión exitoso',
            'usuario' => $usuario,
        ]);
    }



    // O B T E N E R L I S T A
    public function listarServicios()
    {
        $servicios = Servicio::all();
        return response()->json(['servicios' => $servicios]);
    }

    // C R E A R S O L I C I T U D
    public function crearSolicitud(Request $request)
    {
        // Para debug: ver qué llega
        // dd($request->all());

        $request->validate([
            'id_usuario' => 'required',
            'fecha' => 'required',
            'id_servicio' => 'required',
        ]);

        try {
            $solicitud = new Solicitud();
            $solicitud->fecha = $request->fecha;
            $solicitud->id_usuario = $request->id_usuario;
            $solicitud->id_servicio = $request->id_servicio;
            $solicitud->save();

            return response()->json(['mensaje' => 'Solicitud creada correctamente']);
        } catch (\Exception $e) {
            return response()->json([
                'mensaje' => 'Error al crear solicitud',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // L I S T A R S O L I C I T U D E S USUARIO
    public function listarSolicitudesUsuario($id_usuario)
    {
        $solicitudes = Solicitud::where('id_usuario', $id_usuario)
                    ->join('servicios', 'solicitudes.id_servicio', '=', 'servicios.id_servicio')
                    ->select('solicitudes.*', 'servicios.nombre as nombre_servicio')
                    ->get();

        return response()->json(['solicitudes' => $solicitudes]);
    }

    // L I S T A R S O L I C I T U D E S ADMIN
    public function listarSolicitudes()
    {
    $solicitudes = Solicitud::join('usuarios', 'solicitudes.id_usuario', '=', 'usuarios.id_usuario')
        ->join('servicios', 'solicitudes.id_servicio', '=', 'servicios.id_servicio')
        ->select('solicitudes.*', 'usuarios.nombre as nombre_usuario', 'servicios.nombre as nombre_servicio')
        ->get();

    return response()->json(['solicitudes' => $solicitudes]);
    }

    //  C R E A R E V E N T O
    public function crearEvento(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'fecha' => 'required|date',
        ]);

        $evento = Evento::create([
            'nombre' => $request->nombre,
            'fecha' => $request->fecha,
        ]);

        return response()->json(['mensaje' => 'Evento creado', 'evento' => $evento]);
    }


    // C R E A R M A N Z A N A
    Public function crearManzana(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $manzana = Manzana::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json(['mensaje' => 'Manzana creada', 'manzana' => $manzana]);
    }

    // C R E A R S E R V I C I O
    public function crearServicio(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
        ]);

        $servicio = Servicio::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json(['mensaje' => 'Servicio creado', 'servicio' => $servicio]);
    }
}
