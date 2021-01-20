<?php

namespace App\Backend\Controllers;

use App\Backend\Requests\Post\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsController extends MainController
{
    public function index()
    {
        $posts = Post::getAllPgt(config('params.perPage'));
        return view('B::posts.index', compact('posts'));
    }

    public function search(Request $request)
    {
        $tags = Tag::DashBoardSearchPgt($request->all(), config('params.perPage'));
        return view('B::tags.index', compact('tags'));
    }

    public function visibility($id)
    {
        if (Post::changeVisibility($id)) {
            return $this->successRedirect('posts.index');
        }

        return $this->errorRedirect();
    }

    public function create()
    {
        $categories = Category::getAllPluck();
        $tags = Tag::getAllPluck();

        return view('B::posts.create', compact('categories', 'tags'));
    }

    public function store(PostRequest $request)
    {
        if (Post::addItem($request->input())) {
            return $this->successRedirect('posts.index');
        }

        return $this->errorRedirect();
    }

    public function edit($id)
    {
        $post = Post::getById($id);
        $categories = Category::getAllPluck();
        $tags = Tag::getAllPluck();

        return view('B::posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(PostRequest $request, $id)
    {
        $post = Post::getById($id);
        $post->update($request->input());
        $post->tags()->sync($request->input('tags'));
    }

    public function destroy($id)
    {
        if($post = Post::destroyItem($id)) {
            return $this->errorRedirect($post);
        }

        return $this->successRedirect('posts.index', config('params.flash.delete'));
    }
}

