<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        try {
            $sql = Product::get();
            if($sql) {
                return response()->json([ 'status'=> 'Success', 'message' => "Productos obtenidos correctamente", 'data' => $sql ], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "Error al consultar los productos",'data' => $e->getMessage()], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al consultar los productos",'data' => $e->getMessage()], 422);
        }
    }

    public function getProduct(Request $request, $id)
    {
        try {
            $sql = Product::where('id', $id)->get();
            if($sql) {
                return response()->json([ 'status'=> 'Success', 'message' => "Producto obtenido correctamente", 'data' => $sql ], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "Error al consultar el producto",'data' => $e->getMessage()], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al consultar el producto",'data' => $e->getMessage()], 422);
        }
    }

    public function postProduct(Request $request)
    {
        try {
            $input = $request->all();
            $dataProduct = ([
                'titulo' => array_key_exists('titulo', $input) ? $input['titulo'] : '',
                'precio' => array_key_exists('precio', $input) ? $input['precio'] : '',
                'descripcion' => array_key_exists('descripcion', $input) ? $input['descripcion'] : '',
                'categoria' => array_key_exists('categoria', $input) ? $input['categoria'] : ''
            ]);
            $sql = Product::insert($dataProduct);
            if($sql) {
                return response()->json([ 'status'=> 'Success', 'message' => "Producto creado correctamente", 'data' => $sql ], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "Error al crear el producto",'data' => $e->getMessage()], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al crear el producto",'data' => $e->getMessage()], 422);
        }
    }

    public function updateProduct(Request $request, $id)
    {
        try {
            $input = $request->all();
            $dataProduct = ([
                'titulo' => array_key_exists('titulo', $input) ? $input['titulo'] : '',
                'precio' => array_key_exists('precio', $input) ? $input['precio'] : '',
                'descripcion' => array_key_exists('descripcion', $input) ? $input['descripcion'] : '',
                'categoria' => array_key_exists('categoria', $input) ? $input['categoria'] : ''
            ]);
            $sql = Product::where('id', $id)->update($dataProduct);
            if($sql) {
                return response()->json([ 'status'=> 'Success', 'message' => "Producto actualizado correctamente", 'data' => $sql ], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "Error al actualizar el producto",'data' => $e->getMessage()], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al actualizar el producto",'data' => $e->getMessage()], 422);
        }
    }

    public function deleteProduct(Request $request)
    {
        try {
            $id = $request['id'];
            $sql = Product::where('id', $id)->delete();
            if($sql) {
                return response()->json([ 'status'=> 'Success', 'message' => "Producto eliminado correctamente", 'data' => $sql ], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "Error al eliminar el producto",'data' => $e->getMessage()], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al eliminar el producto",'data' => $e->getMessage()], 422);
        }
    }
    
}
