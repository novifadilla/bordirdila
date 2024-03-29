<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests\CreateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
    	//$sql = "SELECT * FROM categories";
    	//$categories = DB::select($sql);

    	$categories = DB::table('categories')
			->get();
			
		$user = DB::table('users')
	    	->where('id', session('user')->id)
            ->first(); 

    	return view('category.index', ['categories' => $categories, 'user'=>$user]);
    }


    public function create()
    {
		$user = DB::table('users')
	    	->where('id', session('user')->id)
			->first(); 
			
    	return view('category.create', ['user'=>$user]);
    }

    public function edit($id)
    {
    	$category = DB::table('categories')
    		->where('categoryId', $id)
			->first();
			
		$user = DB::table('users')
	    	->where('id', session('user')->id)
			->first(); 

    	return view('category.edit', ['category' => $category, 'user'=>$user]);
    }

    public function delete($id)
    {
    	$category = DB::table('categories')
    		->where('categoryId', $id)
			->first();
			
		$user = DB::table('users')
	    	->where('id', session('user')->id)
			->first(); 

    	return view('category.delete', ['category' => $category, 'user'=>$user]);
    }

    public function store(CreateCategoryRequest $request)
    {
        $params = [
            'categoryName' => $request->catname
        ];
    	DB::table('categories')
    		->insert($params);

    	return redirect('/category');
    }

    public function update(Request $request, $id)
    {
    	$params = [
    		'categoryName' => $request->catname
    	];
    	DB::table('categories')
    		->where('categoryId', $id)
    		->update($params);

    	return redirect('/category');
    }

    public function destroy($id)
    {
    	DB::table('categories')
    		->where('categoryId', $id)
    		->delete();

    	return redirect('/category');
    }

    public function search(Request $request)
    {
    	$categories = DB::table('categories')
    		->where('categoryName', 'LIKE', "%$request->searchText%")
    		->get();

    	return view('category.index', ['categories' => $categories]);
    }
}
