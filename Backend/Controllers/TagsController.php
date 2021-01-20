<?php

namespace App\Backend\Controllers;

use App\Backend\Requests\Tag\TagRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends MainController
{
    public function index()
    {
        $tags = Tag::getAllPgt(config('params.perPage'));
        return view('B::tags.index', compact('tags'));
    }

    public function search(Request $request)
    {
        $tags = Tag::DashBoardSearchPgt($request->all(), config('params.perPage'));
        return view('B::tags.index', compact('tags'));
    }

    public function visibility($id)
    {
        if (Tag::changeVisibility($id)) {
            return $this->successRedirect('tags.index');
        }

        return $this->errorRedirect();
    }

    public function create()
    {
        return view('B::tags.create');
    }

    public function store(TagRequest $request)
    {
        if (Tag::addItem($request->input())) {
            return $this->successRedirect('tags.index');
        }

        return $this->errorRedirect();
    }

    public function edit($id)
    {
        $tag = Tag::getById($id);
        return view('B::tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, $id)
    {
        if (Tag::updateItem($request->input(), $id)) {
            return $this->successRedirect('tags.index');
        }

        return $this->errorRedirect();
    }

    public function destroy($id)
    {
        if(Tag::destroyItem($id)) {
            return $this->successRedirect('tags.index', config('params.flash.delete'));
        }

        return $this->errorRedirect();
    }
}

