<?php

namespace App\Contracts\Repositories;
use App\Contracts\Interfaces\ArticleInterface;
use App\Services\ArticleService;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;

class ArticleRepository extends BaseRepository implements ArticleInterface
{
    public ArticleService $articleService;

    public function __construct(Article $article, ArticleService $articleService)
    {
        $this->model = $article;
        $this->articleService = $articleService;
    }

    public function show(string $id)
    {
        return $this->model->query()->findOrFail($id);
    }

    public function get()
    {
        return $this->model->query()->get();
    }

    public function store(array $data)
    {
        $article = $this->show($data['id']);
        if (isset($data['image'])) {
            $article->image = $data['image']->store('articles');
        }
        return $this->model->query()->create($data);
    }

    public function update(string $id, array $data)
    {
        $article = $this->show($data['id']);
        if (isset($data['image'])) {
            if (isset($article->image) && Storage::exists($article->image)) {
                Storage::delete($article->image);
            }
            $article->image = $data['image']->store('articles');
        }
        return $this->model->query()->findOrFail($id)->update($data);
    }

    public function delete(string $id)
    {
        if (isset($this->show($id)->image) && Storage::exists($this->show($id)->image)) {
            Storage::delete($this->show($id)->image);
        }
        return $this->model->query()->findOrFail($id)->delete();
    }
}
