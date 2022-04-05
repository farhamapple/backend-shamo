<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Helpers\ResponseFormatter;

class ProductCategoriesController extends Controller
{
    //
    public function all(Request $request){
        $id = $request->input('id');
        $limit = $request->input('limit');
        $name = $request->input('name');
        $show_product = $request->input('show_product');

        if($id){
            $categories = ProductCategory::find($id);

            if($categories){
                return ResponseFormatter::success(
                    $categories,
                    'Data Kategori Produk Berhasil diambil'
                );
            }else{
                return ResponseFormatter::error(
                    null,
                    'Data Kategori Produk Tidak ada',
                    404
                );
            }
        }

           $categories = ProductCategory::query();

        if($name){
            $categories->where('name', 'like', '%'.$name.'%');
        }

        if($show_product){
            $categories->with('products');
        }

        return ResponseFormatter::success(
            $categories->paginate($limit),
            'Data Kategori Produk Berhasil diambil'
        );

    }
}
