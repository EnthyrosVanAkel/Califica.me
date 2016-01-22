<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//REQUESTS
use App\Http\Requests\PersonalRequest;
use App\Http\Requests\DireccionRequest;
use App\Http\Requests\EmergenciaRequest;
use App\Http\Requests\AcademicaRequest;
use App\Http\Requests\HabilidadRequest;
use App\Http\Requests\UpdateProyectoRequest;
use App\Http\Requests\NuevoProyectoRequest;
use App\Http\Requests\RecursosRequest;
use App\Http\Requests\TareaRequest;
//
use App\Http\Requests;
use App\Http\Controllers\Controller;
// Se agrega Auth y User
use App\User;
use App\Becario;
use App\Direccion;
use App\Emergencia;
use App\Academica;
use App\Habilidad;
use Auth;
//Rekacion Becario / Proyecto
use App\BP;
// EVALUACIONES
use App\Evaluacion;
use App\Tarea;
//Sin relaicon
use App\Recurso;
use App\Proyecto;
use App\Proyecto_archivo;
use Storage;
//use DB;
//
//
//
//
class AdministradorController extends Controller
{
    //
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('Admin/index');
    }


//////PROYECTOSSS
    public function list_proyectos(){
        $user = Auth::user();
        $proyectos = Proyecto::all();
        $ctin = Proyecto::where('tipo','CTIN')->get();
        $carso = Proyecto::where('tipo','Carso')->get();
        $operacion = Proyecto::where('tipo','Operación CTIN')->get();
        //$becario = with('emergencia','direccion','academicas','habilidades');
        return view('Admin/Proyecto/index',compact('user','proyectos','ctin','carso','operacion'));

    }

     public function show_proyecto($id){
        $user = Auth::user();
        $proyecto = Proyecto::find($id);
        return view('Admin/Proyecto/show_proyecto',compact('user','proyecto'));
    }
    public function alta_proyecto(NuevoProyectoRequest $request){
        
        if($request){
            $proyecto = new Proyecto();
            $in = $request->input('integrante');
            $proyecto->nombre = $request->input('proyecto');
            $proyecto->url_logo = 'project.png';
            $proyecto->max_integrantes = $request->input('maximo');
            $proyecto->tipo = $request->input('tipo');
            $proyecto->area = $request->input('area');
            $proyecto->save();
            //Busca al usuario en la tabla User
            $user = User::where('carso',$in)->firstOrFail();
            //crea el nuevo integrante con las relaciones
            $int = $proyecto->integrantes;
            $integrante = new BP();
            $integrante->proyecto_id = $proyecto->id;
            $integrante->becario_id = $user->becario->id;
            $integrante->save();
                
            //Aumenta el contador de integrantes
            $proyecto->integrantes = $int +1;
            $proyecto->save();

            //crear los recursos
            $infografia = new Proyecto_archivo();
            $infografia->proyecto_id = $proyecto->id;
            $infografia->url_archivo = 'infografia'.$proyecto->id;
            $infografia->save();
            $presentacion = new Proyecto_archivo();
            $presentacion->proyecto_id = $proyecto->id;
            $presentacion->url_archivo = 'presentacion'.$proyecto->id;
            $presentacion->save();            
            $plan = new Proyecto_archivo();
            $plan->proyecto_id = $proyecto->id;
            $plan->url_archivo = 'plan'.$proyecto->id;
            $plan->save();
            $extra = new Proyecto_archivo();
            $extra->proyecto_id = $proyecto->id;
            $extra->url_archivo = 'extra'.$proyecto->id;
            $extra->save();

        }
        return redirect('admin/proyectos');
    }


    public function edit_proyecto($id){
        $user = Auth::user();
        $proyecto = Proyecto::find($id);
        return view('Admin/Proyecto/edit_proyecto',compact('user','proyecto'));
    }

    public function update_proyecto($id,UpdateProyectoRequest $request){
        $proyecto = Proyecto::find($id);
        $proyecto->nombre = $request->input('nombre');
        $proyecto->progreso = $request->input('progreso');
        $proyecto->tipo = $request->input('tipo');
        $proyecto->area = $request->input('area');
        $proyecto->end = $request->input('end');
        $proyecto->descripcion = $request->input('descripcion');

        if($request->file('imagen')){
            $file = $request->file('imagen');
            $nombre = 'proyecto'.$proyecto->id;
            Storage::put('proyectos/logos/'.$nombre, \File::get($file));
            $proyecto->url_logo = $nombre;
            $proyecto->save();   
        }
        else{
            $proyecto->save();  
        }
        return redirect('admin/proyectos/'.$proyecto->id.'/edit');
    }


    public function subir_recursos($id,RecursosRequest $request){
        $proyecto = Proyecto::find($id);
        $infografia = Proyecto_archivo::where('url_archivo','infografia'.$proyecto->id)->first();
        $presentacion = Proyecto_archivo::where('url_archivo','presentacion'.$proyecto->id)->first();
        $plan = Proyecto_archivo::where('url_archivo','plan'.$proyecto->id)->first();
        $extra = Proyecto_archivo::where('url_archivo','extra'.$proyecto->id)->first();


        if($request->file('infografia')){
            $a_i = $request->file('infografia');
            $e_i = $request->file('infografia')->getClientOriginalExtension();
            $n_i = 'infografia'.$proyecto->id.'.'.$e_i;
            Storage::put('proyectos/recursos/'.$n_i, \File::get($a_i));
            $infografia->url_archivo = $n_i;
            $infografia->nombre = 'infografía';  
            $infografia->save();   
        }

        if($request->file('presentacion')){
            $a_p = $request->file('presentacion');
            $e_p = $request->file('presentacion')->getClientOriginalExtension();
            $n_p = 'presentacion'.$proyecto->id.'.'.$e_p;
            Storage::put('proyectos/recursos/'.$n_p, \File::get($a_p));
            $presentacion->url_archivo = $n_p;
            $presentacion->nombre = 'presentación';
            $presentacion->save();   
        }

        if($request->file('plan')){
            $a_l = $request->file('plan');
            $e_l = $request->file('plan')->getClientOriginalExtension();
            $n_l = 'plan'.$proyecto->id.'.'.$e_l;
            Storage::put('proyectos/recursos/'.$n_l, \File::get($a_l));
            $plan->url_archivo = $n_l;
            $plan->nombre = 'plan';
            $plan->save();   
        }

        if($request->file('extra')){
            $a_e = $request->file('extra');
            $e_e = $request->file('extra')->getClientOriginalExtension();
            $n_e = 'extra'.$proyecto->id.'.'.$e_e;
            Storage::put('proyectos/recursos/'.$n_e, \File::get($a_e));
            $extra->url_archivo = $n_e;
            $extra->nombre = 'extra';
            $extra->save();   
        }

        return redirect('admin/proyectos/'.$proyecto->id.'/edit');
    }


public function agregar_integrantes($id,Request $request){
        $proyecto = Proyecto::find($id);
        //0$int = $proyecto->integrantes;
        $entradas = count($request->all());
        for ($i=0; $i < $entradas; $i++) {
            if ($request->input('integrante'.($proyecto->integrantes+($i+1)))) {
                
                //Busca al usuario en la tabla User
                $user = User::where('carso',$request->input('integrante'.($proyecto->integrantes+($i+1))))->firstOrFail();
                //crea el nuevo integrante con las relaciones
                $int = $proyecto->integrantes;
                $integrante[$i] = new BP();
                $integrante[$i]->proyecto_id = $proyecto->id;
                $integrante[$i]->becario_id = $user->becario->id;
                $integrante[$i]->save();
                
                //Aumenta el contador de integrantes
                $proyecto->integrantes = $int +1;
                $proyecto->save();
             } 
        }
        return redirect('admin/proyectos/'.$proyecto->id.'/edit');
    }

}
