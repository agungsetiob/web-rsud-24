<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (Auth::user()->role == 'admin')
        {
            $categories = Category::all();
            return view('admin.category', compact('categories'));
        } else {
            abort(403, "You don't have permission");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->status = 'enabled';
        $category->save();

        return redirect()->back()->with('success','Data added successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        if (Auth::user()->role == 'admin') {
            $category = Category::findOrFail($id);
            $category->delete();
        
        return redirect('category')->with('success', 'Data Deleted Successfully');
        } else{
            return redirect()->back()->with('error', 'Many ways to rome');
        }
        
    }

    public function disableCategory($id, Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $cat = Category::findOrFail($id);
            $cat->update([
                'status'     => 'disabled'
            ]);
            return redirect()->back()->with('success', 'Category is disabled successfully');
        }
    }

    public function enableCategory($id, Request $request)
    {
        if (Auth::user()->role == 'admin') {
            $cat = Category::findOrFail($id);
            $cat->update([
                'status'     => 'enabled'
            ]);
            return redirect()->back()->with('success', 'Category is enabled successfully');
        }
    }
}
