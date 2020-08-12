<?php

namespace App\Http\Controllers\Api;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Log;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return LengthAwarePaginator|mixed
     */
    public function index(Request $request)
    {
        if ($request->user()->is_admin) {
            return Client::loadAll();
        }
        return Client::loadAllMine($request->user()->id);
    }

    /**
     * get all published articles
     *
     * @return mixeduse App\File;
     */
    public function publishedArticles()
    {
        return Client::loadAllPublished();
    }

    /**
     * Get single published Client
     *
     * @param $slug
     * @return mixed
     */
    public function publishedArticle($slug)
    {
        return Client::loadPublished($slug);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Сохраняем новый созданный объект в БД
     *
     * @param ArticleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $user = $request->user();

        $article = new Client($request->validated());
        $article->slug = Str::slug($request->get('title'));

        if ($request['image']){
            $fileName = "fileName" . time() . '.' . $request['image']->getClientOriginalExtension();
            $request['image']->move(public_path('/images/article_images'), $fileName);
            $article['image'] = $fileName;
        }

        $user->articles()->save($article);


        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if (!$request->user()->is_admin) {
            return Client::mine($request->user()->id)->findOrFail($id);
        }

        return Client::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, $id)
    {
        Log::info($request);
        $article = Client::findOrFail($id);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        if ($request['image']){
            $fileName = "fileName" . time() . '.' . $request['image']->getClientOriginalExtension();

            $file = public_path('/images/article_images/' . $article->image);
            if (file_exists($file)) {
                unlink($file);
            }

            $request['image']->move(public_path('/images/article_images'), $fileName);
            $data['image'] = $fileName;
        }

        $article->update($data);

        return response()->json($article, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $article = Client::findOrFail($id);

        $article->delete();

        return response([], 200);
    }
}
