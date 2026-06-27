<?php

namespace App\Http\Livewire\Admin\Seo;

use App\Models\Seo;
use App\Models\Article;
use Livewire\Component;

class SeoManager extends Component
{
    public ?int $seoableId = null;
    public ?string $seoableType = null;
    public ?Seo $seoEntry = null;

    public $meta_title = '';
    public $meta_description = '';
    public $keywords = '';
    public $canonical_url = '';
    public $og_title = '';
    public $og_description = '';
    public $og_image = '';
    public $twitter_card = 'summary_large_image';
    public $twitter_title = '';
    public $twitter_description = '';
    public $twitter_image = '';
    public $schema_markup = '';

    protected function rules(): array
    {
        return [
            'meta_title' => 'nullable|string|max:70',
            'meta_description' => 'nullable|string|max:160',
            'keywords' => 'nullable|string|max:255',
            'canonical_url' => 'nullable|url|max:500',
            'og_title' => 'nullable|string|max:100',
            'og_description' => 'nullable|string|max:300',
            'og_image' => 'nullable|string|max:500',
            'twitter_card' => 'nullable|string|in:summary,summary_large_image,app,player',
            'twitter_title' => 'nullable|string|max:100',
            'twitter_description' => 'nullable|string|max:300',
            'twitter_image' => 'nullable|string|max:500',
            'schema_markup' => 'nullable|string',
        ];
    }

    public function mount(?int $seoableId = null, ?string $seoableType = null): void
    {
        $this->seoableId = $seoableId;
        $this->seoableType = $seoableType;

        if ($seoableId && $seoableType) {
            $modelClass = $this->resolveClass($seoableType);
            $model = $modelClass::find($seoableId);
            if ($model) {
                $seo = $model->seo;
                if ($seo) {
                    $this->seoEntry = $seo;
                    $this->fill([
                        'meta_title' => $seo->meta_title,
                        'meta_description' => $seo->meta_description,
                        'keywords' => $seo->keywords,
                        'canonical_url' => $seo->canonical_url,
                        'og_title' => $seo->og_title,
                        'og_description' => $seo->og_description,
                        'og_image' => $seo->og_image,
                        'twitter_card' => $seo->twitter_card ?? 'summary_large_image',
                        'twitter_title' => $seo->twitter_title,
                        'twitter_description' => $seo->twitter_description,
                        'twitter_image' => $seo->twitter_image,
                        'schema_markup' => $seo->schema_markup,
                    ]);
                }
            }
        }

        $this->seedDefaults();
    }

    protected function seedDefaults(): void
    {
        if (!$this->seoEntry && $this->seoableId && $this->seoableType) {
            $modelClass = $this->resolveClass($this->seoableType);
            $model = $modelClass::find($this->seoableId);
            if ($model) {
                $this->meta_title ??= $model->title ?? $model->name ?? '';
                $this->meta_description ??= $model->excerpt ?? $model->description ?? '';
                $this->og_title ??= $this->meta_title;
                $this->og_description ??= $this->meta_description;
                $this->twitter_title ??= $this->meta_title;
                $this->twitter_description ??= $this->meta_description;
                $this->og_image ??= $model->featured_image ?? '';
                $this->twitter_image ??= $this->og_image;
            }
        }
    }

    public function save(): void
    {
        $this->validate();

        if (!$this->seoableId || !$this->seoableType) {
            $this->dispatch('notify', type: 'error', message: 'No entity associated with this SEO entry.');
            return;
        }

        $data = [
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'keywords' => $this->keywords,
            'canonical_url' => $this->canonical_url,
            'og_title' => $this->og_title,
            'og_description' => $this->og_description,
            'og_image' => $this->og_image,
            'twitter_card' => $this->twitter_card,
            'twitter_title' => $this->twitter_title,
            'twitter_description' => $this->twitter_description,
            'twitter_image' => $this->twitter_image,
            'schema_markup' => $this->schema_markup,
        ];

        $modelClass = $this->resolveClass($this->seoableType);
        $model = $modelClass::find($this->seoableId);

        if (!$model) {
            $this->dispatch('notify', type: 'error', message: 'Entity not found.');
            return;
        }

        if ($this->seoEntry) {
            $this->seoEntry->update($data);
            $this->dispatch('notify', type: 'success', message: 'SEO metadata updated.');
        } else {
            $model->seo()->create($data);
            $this->dispatch('notify', type: 'success', message: 'SEO metadata created.');
        }
    }

    protected function resolveClass(string $type): string
    {
        return match ($type) {
            'article' => Article::class,
            'category' => \App\Models\Category::class,
            'tag' => \App\Models\Tag::class,
            default => Article::class,
        };
    }

    public function render()
    {
        return view('livewire.admin.seo.seo-manager');
    }
}
