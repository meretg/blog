<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Product;
use App\Subcatgory;


class TestController extends Controller
{
    public function index()
    {
        // $category = Category::with('products')->get();
        $categories =Category::get();
        return view('welcome',compact('categories'));

    	// return view()->exists('welcome');
      //  ? view('welcome',compact('categories')) : '';
    }
    public function getproduct(Request $request)
    {
        // $category = Category::with('products')->get();
        $Products =Product::where('category_id',$request->cat_id)->get();
        $Sub_products=[];
        foreach ($Products as $Product) {
          $Product->Subcatgorys =Subcatgory::where('pro_id','=',$Product->id)->get();

        }
        // return view('welcome',compact('Products'));
        // print_r($Products);
        $response = array(
          'status'=>'success',
                      'Products' => $Products,
                    );
                    return response()->json($response);
      // return view()->exists('welcome');
      //  ? view('welcome',compact('categories')) : '';
    }

    public function getsubproduct(Request $request)
    {
        // $category = Category::with('products')->get();
        $Subproducts =Subcatgory::where('pro_id','=',$request->pro_id)->get();
        // return view('welcome',compact('Products'));
        $response = array(
          'status'=>'success',
                      'Subproducts' => $Subproducts,
                    );
                    return response()->json($response);
      // return view()->exists('welcome');
      //  ? view('welcome',compact('categories')) : '';
    }
}
