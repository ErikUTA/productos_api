<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    public function getProducts(Request $request)
    {
        try {
            $sqlProduct = Product::get();
            if(!is_null($sqlProduct)) {
                $res = [];
                foreach($sqlProduct as $product) {
                    $sqlCategory = Category::select('name')->where('id', $product['categoria'])->first();
                    array_push($res, [
                        'id' => $product['id'],
                        'titulo' => $product['titulo'],
                        'precio' => $product['precio'],
                        'descripcion' => $product['descripcion'],
                        'categoria' => $sqlCategory['name'],
                    ]);
                }
                return response()->json([ 'status'=> 'Success', 'message' => "Productos obtenidos correctamente", 'data' => $res ], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "No hay productos disponibles",'data' => $sqlProduct], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al consultar los productos",'data' => $e->getMessage()], 422);
        }
    }

    public function getProduct(Request $request)
    {
        try {
            $input = $request->all();
            $sqlProduct = Product::where('id', $input['id'])->first();
            if(!is_null($sqlProduct)) {
                $sqlCategory = Category::select('name')->where('id', $sqlProduct['categoria'])->first();
                $res = ([
                    'id' => $sqlProduct['id'],
                    'titulo' => $sqlProduct['titulo'],
                    'precio' => $sqlProduct['precio'],
                    'descripcion' => $sqlProduct['descripcion'],
                    'categoria' => $sqlCategory['name'],
                ]);
                return response()->json([ 'status'=> 'Success', 'message' => "Producto obtenido correctamente", 'data' => $res ], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "No existe el producto",'data' => $sqlProduct], 422);
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
            if(!is_null($sql)) {
                return response()->json([ 'status'=> 'Success', 'message' => "Producto creado correctamente", 'data' => $dataProduct], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "Error al crear el producto",'data' => $sql], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al crear el producto",'data' => $e->getMessage()], 422);
        }
    }

    public function updateProduct(Request $request)
    {
        try {
            $input = $request->all();
            $dataProduct = ([
                'titulo' => array_key_exists('titulo', $input) ? $input['titulo'] : '',
                'precio' => array_key_exists('precio', $input) ? $input['precio'] : '',
                'descripcion' => array_key_exists('descripcion', $input) ? $input['descripcion'] : '',
                'categoria' => array_key_exists('categoria', $input) ? $input['categoria'] : ''
            ]);
            $sql = Product::where('id', $input['id'])->update($dataProduct);
            if($sql === 1) {
                return response()->json([ 'status'=> 'Success', 'message' => "Producto actualizado correctamente", 'data' => $sql], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "No existe el producto",'data' => $sql], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al actualizar el producto",'data' => $e->getMessage()], 422);
        }
    }

    public function deleteProduct(Request $request)
    {
        try {
            $input = $request->all();
            $sql = Product::where('id', $input['id'])->delete();
            if($sql === 1) {
                return response()->json([ 'status'=> 'Success', 'message' => "Producto eliminado correctamente", 'data' => $sql ], 200);
            } else {
                return response()->json(['status'=>'Error','message' => "No existe el producto",'data' => $sql], 422);
            }
        }catch(\Exception $e){
            return response()->json(['status'=>'Error','message' => "Error al eliminar el producto",'data' => $e->getMessage()], 422);
        }
    }
    
}
