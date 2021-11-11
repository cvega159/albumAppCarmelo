<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResourceController extends Controller{
    
    public function index(Request $request){//te muestra todos los registros
        $resources = [];//creo el array donde voy a meter los recursos
        if($request->session()->exists('resources')) {//comprueba que dentro de la sesion has metido ya algun dato
            $resources = $request->session()->get('resources');
        }
        $enterprise = 'Pasteleria';//meto el nombre de la empresa
        $data = [];//creo el array donde voy a meter los recursos y el nombre de la empresa
        $data['resources'] = $resources;//añado los recursos
        $data['enterprise'] = $enterprise;//añado el nombre de la empresa
        return view('resource.index',$data);//te duvuelve la vista (en la carpeta resource el archivo que se llama index)
    }

    public function create(){//este muestra el formulario con el que voy a dar de alta
        $enterprise = 'Pasteleria';
        $data = [];
        $data['enterprise'] = $enterprise;
        return view('resource.create', $data);//te duvuelve la vista (en la carpeta resource el archivo que se llama create)
    }

    public function store(Request $request){//este inserta el registro y luego hace un redirect
       //en la variable priece mete la informacion que escriba en el input de priece
        $resources = [];//creo el array de recursos
        if($request->session()->exists('resources')) {//si la sesion existe y hay recursos
            $resources = $request->session()->get('resources');//meto en el array de recursos los datos que haya en la sesion
            $array=end($resources);//bucamos el ultimo elemento del array resources y lo guardamos en el array $array
            if(isset($array['id'])){
                $id=$array['id']+1;//metemos en la variable id el valor del array del ultimo elemento y le sumamos 1
            }else{
                $id=1;
            }
        }else{
            //$id=count($resources)+1;
            $id=1;//si no hay ningun recurso todavia le da al primer el valor 1
        } 
        $name = $request->input('name');//en la variable name mete la informacion que escriba en el input de name
        $priece = $request->input('priece');
        $resource = ['id' => $id, 'name' => $name, 'priece' => $priece];//mete en el array de recursos el id, el nombre y el precio
        if(isset($resources[$id])) {//si existe el id
            return back()->withInput();//me devuelve al index si hacer nada
        } else {
            $resources[$id] = $resource;//me saca el id del array de recursos y lo mete en el recurso
        }
        if($request->session()->exists('message')) {//si la sesion existe
            $data['message']=$request->session()->get('message');//me añade el mensaje
        }
        $request->session()->put('resources', $resources);//las respuestas me las escribe en el array de recursos
        return redirect('resource')->with('message', 'Se ha insertado el elemento correctamente');//me redirige al index con el mensaje
    }

    public function show(Request $request, $id){//este muestra el elemento
       if($request->session()->exists('resources') && isset($request->session()->get('resources')[$id])) {//si el elemento que quiero visualizar existe
            $resource = $request->session()->get('resources')[$id];//me mete el id en el array de recursos
            $data = [];
            $data['resource'] = $resource;
            $data['enterprise'] = 'Pasteleria';
            return view('resource.show',$data); //te devuelve la vista (en la carpeta resource el archivo que se llama show)
        }
        return redirect('resource');//te manda al index
    }

    public function edit(Request $request, $id){//este muestra el formulario con el que voy a editar
        if($request->session()->exists('resources') && isset($request->session()->get('resources')[$id])){//si el elemento que quiero visualizar existe
            $resource = $request->session()->get('resources')[$id];//me guarda el id en el array de recursos
            $data = [];
            $data['resource'] = $resource;
            $data['enterprise'] = 'Pasteleria';
            return view('resource.edit', $data);//te devuelve la vista (en la carpeta resource el archivo que se llama edit)
        }
    }

    public function update(Request $request, $id){//este edita el registro con el id y luego hace un redirect
        if($request->session()->exists('resources')) {
            $resources = $request->session()->get('resources');//meto los datos que hay en el array de recursos
            if(isset($resources[$id])) {//si existe ese id en el array de recursos
                $resource = $resources[$id];//cojo el id que esta en el array de recursos
                $idInput = $id;//en la variable idInput mete el id que hay(el que ponemos nosotros por defecto)
                $nameInput = $request->input('name');//en la variable nameInput meto el valor que estoy escribiendo en el input del name
                $prieceInput = $request->input('priece');//en la variable prieceInput meto el valor que estoy escribiendo en el input del price
                $resource['id'] = $idInput;//meto en el recurso del id el valor del idInput
                $resource['name'] = $nameInput;//meto en el recurso del name el valor del nameInput
                $resource['priece'] = $prieceInput;//meto en el recurso del precio el valor del prieceInput
                $resources[$idInput] = $resource;//mete el nuevo id en el array de recurso
                $request->session()->put('resources', $resources);
                return redirect('resource')->with('message', 'Se ha editado el elemento correctamente');
            }
        }
        return back()->withInput();//te lleva a la pantalla del index
    }

    public function destroy(Request $request, $id){//este borra el registro
        $message='No se ha borrado el elemento correctamente';
        $type='danger';
         if($request->session()->exists('resources')) {//si la sesion existe
            $resources = $request->session()->get('resources');
            if(isset($resources[$id])) {//dentro de la lista existe el elemento id
                unset($resources[$id]);//borramos el id
                $request->session()->put('resources', $resources);//guardamos en la sesion
                $message='Se ha borrado el elemento correctamente';
                $type='success';
            }
         }
         $data=[];
         $data['message']=$message;
         $data['type']=$type;
         return redirect('resource')->with($data);
    }
    
}
