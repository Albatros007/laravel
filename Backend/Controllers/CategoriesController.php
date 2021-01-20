<?php

namespace App\Backend\Controllers;

use App\Models\Category;
use App\Backend\Requests\Category\CategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends MainController
{
    public function index()
    {
        //Category::setSortField('title');;
        //Category::setSortProtectedFields(['id', 'is_hidden']);
        $categories = Category::getAllPgt(config('params.perPage'));
        return view('B::categories.index', compact('categories'));
    }

    public function search(Request $request)
    {
        $categories = Category::DashBoardSearchPgt($request->all(), config('params.perPage'));
        return view('B::categories.index', compact('categories'));
    }

    public function visibility($id)
    {
        if (Category::changeVisibility($id)) {
            return $this->successRedirect('categories.index');
        }

        return $this->errorRedirect();
    }

    public function create()
    {
        return view('B::categories.create');
    }

    public function store(CategoryRequest $request)
    {
        if (Category::addItem($request->input())) {
            return $this->successRedirect('categories.index');
        }

        return $this->errorRedirect();
    }

    public function edit($id)
    {
        $category = Category::getById($id);
        return view('B::categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, $id)
    {
        if (Category::updateItem($request->input(), $id)) {
            return $this->successRedirect('categories.index');
        }

        return $this->errorRedirect();
    }

    public function destroy($id)
    {
        if(Category::destroyItem($id)) {
            return $this->successRedirect('categories.index', config('params.flash.delete'));
        }

        return $this->errorRedirect();
    }
}

