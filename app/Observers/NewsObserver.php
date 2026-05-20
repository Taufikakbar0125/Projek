<?php

namespace App\Observers;

use App\Models\News;

class NewsObserver
{
    public function created(News $news): void
    {
        if ($news->status === 'published') {
            $this->handleArchiving();
        }
    }

    public function updated(News $news): void
    {
        // Hanya jalankan saat kolom status atau is_archived yang berubah
        if ($news->wasChanged('status') || $news->wasChanged('is_archived')) {
            $this->handleArchiving();
        }
    }

    protected function handleArchiving(): void
    {
        $latestIds = News::where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->pluck('id');

        if ($latestIds->isEmpty()) return;

        News::where('status', 'published')
            ->whereNotIn('id', $latestIds)
            ->where('is_archived', false)
            ->update(['is_archived' => true]);

        News::whereIn('id', $latestIds)
            ->where('is_archived', true)
            ->update(['is_archived' => false]);
    }
}