<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function product()
    {
        return view('admin.product');
    }

    public function uploadproduct(Request $request)
    {
        $data = new product();
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('productimage', $imagename);
            $data->image = $imagename;
        } else {
            return redirect()->back()->with('error', 'Image upload failed.');
        }
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->quantity = $request->quantity;
        $data->save();
        return redirect()->back()->with('success', 'Product added successfully.');
    }
    public function showproduct()
    {
        $data = Product::all();
        return view('admin.showproduct' , compact('data'));
    }
    public function deleteproduct($id)
    {
        $data = Product::find($id);
        $data -> delete();
        return redirect() -> back()->with('success', 'Product Deleted.');
    }
    public function updateview($id)
    {
        $data = Product::find($id);
        return view('admin.updateview' , compact('data'));
    }
    public function updateproduct(Request $request,$id)
    {
        $data = Product::find($id);
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('productimage', $imagename);
            $data->image = $imagename;
        } else {
            return redirect()->back()->with('error', 'Image upload failed.');
        }
        $data->title = $request->title;
        $data->price = $request->price;
        $data->description = $request->description;
        $data->quantity = $request->quantity;

        $data->save();
        
        return redirect()->back()->with('success', 'Product update successfully.');
    }
    public function showorder()
    {
        $order = Order::all();
        return view('admin.showorder',compact('order'));
    }
    public function updatestatus($id)
    {
        $order = order::find($id);
        $order -> status = 'delivered';
        $order -> save();
        return redirect()->back();
    }
}
