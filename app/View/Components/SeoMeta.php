<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SeoMeta extends Component
{
    public array $seo;

    public function __construct(
        public ?object $model = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?string $image = null,
        public ?string $type = 'website',
        public ?string $url = null,
        public ?array $schema = null,
    ) {
        $this->seo = $model && method_exists($model, 'getSeoMeta')
            ? $model->getSeoMeta()
            : $this->manualMeta();
    }

    protected function manualMeta(): array
    {
        return [
            'meta_title' => $this->title,
            'meta_description' => $this->description,
            'keywords' => null,
            'canonical_url' => $this->url ?? url()->current(),
            'og_title' => $this->title,
            'og_description' => $this->description,
            'og_image' => $this->image,
            'og_type' => $this->type,
            'twitter_card' => 'summary_large_image',
            'twitter_title' => $this->title,
            'twitter_description' => $this->description,
            'twitter_image' => $this->image,
            'schema_markup' => $this->schema ? json_encode($this->schema) : null,
        ];
    }

    public function render(): View|Closure|string
    {
        return view('components.seo-meta');
    }
}
