@extends('store.layout.master')

@section('body-class', 'single-post right-sidebars')

@section('content')

    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <nav itemprop="breadcrumb" class="woocommerce-breadcrumb"><a href="/">صفحه اصلی</a><span class="delimiter"><i class="fa fa-angle-right"></i></span><a href="/blog">وبلاگ</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>{{ $article->title }}</nav>

            <div id="primary" style="width: 100%; right: 0%" class="content-area">
                <main id="main" class="site-main">
                    <article class="post type-post status-publish format-gallery has-post-thumbnail hentry" >
                        <div class="media-attachment">
                            <div class="media-attachment-gallery">
                                <div class=" ">
                                    <div class="item">
                                        <figure>
                                            <img width="1144" height="600" src="{{ $article->image }}" class="attachment-post-thumbnail size-post-thumbnail" alt="{{ $article->title }}" />
                                        </figure>
                                    </div><!-- /.item -->
                                </div>
                            </div><!-- /.media-attachment-gallery -->
                        </div>

                        <header class="entry-header">
                            <h1 class="entry-title" itemprop="name headline">{{ $article->title }}</h1>

                            <div class="entry-meta">
                                <span class="cat-links"><i class="fa fa-user"></i> {{ $article->user->full_name }}</span>
                                <span class="posted-on"><time class="entry-date published" datetime="2016-03-01T07:40:25+00:00"><i class="fa fa-clock-o"></i> {{ \Morilog\Jalali\Jalalian::forge($article->updated_at)->ago() }}</time></span>
                            </div>
                        </header><!-- .entry-header -->

                        <div class="entry-content" itemprop="articleBody">
                            {{ $article->body }}
                        </div><!-- .entry-content -->
                    </article>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .container -->
    </div><!-- #content -->
@endsection