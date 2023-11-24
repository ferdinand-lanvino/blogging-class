<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArticleCard extends Component
{
    public $article;
    public $teks;

    /**
     * Create a new component instance.
     */
    public function __construct($article, $teks)
    {
        $this->article = $article;
        $this->teks = $teks;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-card');
    }
}
