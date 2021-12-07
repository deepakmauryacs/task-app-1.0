<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Session;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
class productController extends Controller {
    
    public function index() {
        return view('dashboard.index');
    }

    public function addproduct($product_id = '', Request $request) {
        if ($product_id) {
            $Products = Product::find($product_id);
            return view('dashboard.addproduct', ['Product' => $Products]);
        } else {
            return view('dashboard.addproduct');
        }
    }

    public function allproduct() {
        $Products = Product::All();
        return view('dashboard.allproduct', ['Product' => $Products]);
    }

    public function saveproduct(Request $request) {
        $id = $request->input('edit_id');
        //validation rules
        $request->validate(['product_name' => 'required', ]);
        if ($id) {
           
            //print_r($_FILES['product_image']['name']); die();
            $Products = Product::find($id);
            $Products->product_name = $request->input('product_name');
            $Products->quantity = $request->input('quantity');
            
            $Products->price = $request->input('price');

           

         
            if(!empty($_FILES['product_image']['name'])){
                $imageName = time() . '.' . $request->product_image->extension();

                //print_r($imageName); die();
                $request->product_image->move(public_path('products_image'), $imageName);
                $Products->product_image = $imageName;
            }
        
                if ($Products->save()) {
                 $result['status'] = 1;
                 $result['message'] = 'Product Update Successfully... !';
                }

        } else {
            $Products = new Product;
            $Products->product_name = $request->input('product_name');
            $Products->quantity = $request->input('quantity');
            $Products->price = $request->input('price');
            $imageName = time() . '.' . $request->product_image->extension();
            $request->product_image->move(public_path('products_image'), $imageName);
            $Products->product_image = $imageName;
            if ($Products->save()) {
                $result['status'] = 1;
                $result['message'] = 'Product Add Successfully... !';
            }
        }
        echo json_encode($result);
        die;
    }

    public function deleteproduct($id) {
        Product::where('id', $id)->delete();
        return redirect('allproduct')->with('success', 'Commission  delete successfully!');
    }

    public function cart() {
        return view('dashboard.cart');
    }
    
     public function addToCart($id)
     {   
         //$id = $_POST['product_id'];

        
        $product = Product::findOrFail($id);
          
       // print_r($product->product_name); die();


        $cart = session()->get('cart', []);
  

        
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->product_name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->product_image
            ];
        }

    
        session()->put('cart', $cart); 
        return redirect()->back();
     }

  

    public function update(Request $request) {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }

    public function remove(Request $request) {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }
}
