@extends('store.layout.master')

@section('body-class', 'right-sidebar blog-grid')

@section('style')
    <style>
        .pagination {
            position: relative;
            top: 15px;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .pagination:first-of-type {
            margin: 0px;
            padding: 0px;
            position: static;
        }
        .page-item.active .page-link {
            background-color: #ea1b25;
            border-color: #ac0b12;
        }
        .page-link {
            color: #b3020b;
        }
        .page-link:focus, .page-link:hover {
            color: #4d0004;
        }
        .page-item.active .page-link, .page-item.active .page-link:focus, .page-item.active .page-link:hover {
            background-color: #c40c15;
            border-color: #740308;
        }
    </style>
@endsection

@section('content')
    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <nav class="woocommerce-breadcrumb"><a href="/">صفحه اصلی</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>وبلاگ</nav>

            <div id="primary" style="width: 100%" class="content-area">
                <main id="main" class="site-main">
                    @foreach ($articles as $item)
                        <article class="post format-standard hentry">

                        <div class="media-attachment"><a href="/blog/{{ $item->id }}"><img width="870" height="460" src="{{ $item->image }}" class="wp-post-image" alt="{{ $item->title }}" /></a></div>
                            <div class="content-body">
                                <header class="entry-header">
                                    <h1 class="entry-title" itemprop="name headline"><a href="/blog/{{ $item->id }}" rel="bookmark">{{ $item->title }}</a></h1>
                                    <div class="entry-meta">
                                        <span class="cat-links"><i class="fa fa-user"></i> {{ $item->user->full_name }}</span>
                                        <span class="posted-on"><time class="entry-date published" datetime="2016-03-01T07:40:25+00:00"><i class="fa fa-clock-o"></i> {{ \Morilog\Jalali\Jalalian::forge($item->updated_at)->ago() }}</time></span>
                                    </div>
                                </header><!-- .entry-header -->

                                <div class="entry-content" itemprop="articleBody">
                                    <p>{{ $item->description }}</p>
                                </div><!-- .post-excerpt -->

                                <div class="post-readmore"><a href="/blog/{{ $item->id }}" class="btn btn-primary">ادامه مطلب ...</a></div>
                            </div>

                        </article><!-- #post-## -->
                    @endforeach
                    
                    {{ $articles->links() }}
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .container -->
    </div><!-- #content -->
@endsection