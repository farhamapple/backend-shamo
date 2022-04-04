<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //

    public function all(Request $request){
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $description = $request->input('description');
        $tags = $request->input('tags');
        $categories_id = $request->input('categories_id');

        $price_from = $request->input('price_from');
        $price_to = $request->input('price_to');

        if($id){
            $product = Products::with(['product_categories', 'product_galleries'])->find($id);

            if($product){
                return ResponseFormatter::success(
                    $product,
                    'Data Produk Berhasil diambil'
                );
            }else{
                return ResponseFormatter::error(
                    null,
                    'Data Produk Tidak ada',
                    404
                );
            }
        }

        $product = Products::with(['product_categories', 'product_galleries']);

        if($name){
            $product->where('name', 'like', '%'.$name.'%');
        }

        if($description){
            $product->where('description', 'like', '%'.$description.'%');
        }


        if($tags){
            $product->where('tags', 'like', '%'.$tags.'%');
        }

        if($price_from){
            $product->where('price', '>=', $price_from);
        }

        if($price_to){
            $product->where('price', '<=', $price_to);
        }

        if($categories_id){
            $product->where('categories_id', $categories_id);
        }

        return ResponseFormatter::success(
            $product->paginate($limit),
            'Data Produk Berhasil diambil'
        );




    }
}
