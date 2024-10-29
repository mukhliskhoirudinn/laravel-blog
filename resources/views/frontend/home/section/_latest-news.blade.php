<!-- Latest News Start -->
<div class="container-fluid latest-news py-5">
    <div class="container py-5">
        <h2 class="mb-4 text-center">Latest News</h2>
        <div class="latest-news-carousel owl-carousel">
            @foreach ($latest_articles as $article)
                <div class="latest-news-item">
                    <div class="bg-light rounded shadow-sm overflow-hidden">
                        <img src="{{ asset('storage/images/' . $article->image) }}" class="img-zoomin img-fluid"
                            alt="{{ $article->title }}">
                        <div class="p-4">
                            <a href="{{ route('articles.show', $article->slug) }}"
                                class="h5 text-dark">{{ $article->title }}</a>
                            <div class="d-flex justify-content-between mt-2">
                                <a href="#" class="small text-body link-hover">
                                    by {{ optional($article->user)->name ?? 'Unknown' }}
                                </a>
                                <small class="text-body">
                                    <i class="fas fa-calendar-alt me-1"></i>
                                    {{ $article->created_at ? $article->created_at->format('M d, Y') : 'N/A' }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Latest News End -->
