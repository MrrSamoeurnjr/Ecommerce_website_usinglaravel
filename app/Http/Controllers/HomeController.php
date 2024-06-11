<?php
namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        Log::info('User type: '.$usertype); // Add this line
        $data = Product::paginate(3);

        if ($usertype == '1') {
            return view('admin.home');
        } else {
            return view('user.home', compact('data'));
        }
    }

    public function index()
{
  if (Auth::id()) {
    $data = Product::paginate(3);
    $user = auth()->user();
    $count = Cart::where('phone', $user->phone)->count();
    return view('user.home', compact('data', 'count'));
  } else {
    // Handle case when user is not logged in (optional: redirect to login)
    $data = Product::paginate(3);
    return view('user.home', compact('data'));
  }
}

    public function search(Request $request)
    {
        $search = $request->input('search');
        if($search == '')
        {
            $data = Product::paginate(3);
            return view('user.home', compact('data'));
        }
        $data = Product::where('title', 'LIKE', '%' . $search . '%')->paginate(3);
        return view('user.home', compact('data'));
    }
    public function addcart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user = auth()->user();
            $product = Product::find($id);
            $cart = new cart();
            $cart -> name = $user -> name;
            $cart-> address = $user -> address;
            $cart-> product_title = $product -> title;
            $cart-> price = $product -> price;
            $cart-> phone = $user -> phone;
            $cart-> quantity = $product -> quantity;
            // $cart->quantity = $request->quantity; // Correctly get the quantity from the request
            $cart -> save();
            return redirect()->back()->with('success', 'Product update successfully.');
        }
        else 
        {
            return redirect('login');
        }
    }
    public function showcart()
    {
        $user = auth()->user();
        $cart = Cart::where('phone',$user -> phone)->get();
        $count = Cart::where('phone', $user->phone)->count();
        return view('user.showcart', compact('count' , 'cart'));
    }
    public function deletecart($id)
{
  $data = Cart::find($id);
  if($data) { // Check if cart item exists before deleting
    $data->delete();
    return redirect()->back()->with('success', 'Product removed from cart successfully.');
  } else {
    return redirect()->back()->with('error', 'Product not found in your cart.');
  }
}
public function confirmorder(Request $request)
{
  $user = auth()->user();
  $name = $user->name;
  $phone = $user -> phone;
  $address = $user -> address;
  foreach($request->productname as $key=>$productname)
  {
    $order = new order;
    $order -> product_name = $request -> productname[$key];
    $order -> price = $request -> price[$key];
    $order -> quantity = $request -> quantity[$key];
    $order -> name = $name;
    $order -> phone = $phone;
    $order -> address = $address;
    $order -> save();
  }
  DB::table('carts')->where('phone' , $phone)->delete();
  return redirect()->back()->with('success', 'Confirm order successfully');
}
}
?>

