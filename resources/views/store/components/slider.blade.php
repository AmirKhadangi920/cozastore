<div class="home-v1-slider" >
    <!-- ========================================== SECTION – HERO : END========================================= -->

    <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">

        @foreach ($slider as $slide)
            <div class="item" style="background-image: url('{{ asset('slider/'.$slide->photo) }}');">
                <div class="container">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-5" style="margin-top: 12%">
                            <div class="caption vertical-center text-left">
                                <div class="hero-1 fadeInDown-1">
                                    {{ $slide->title }}
                                </div>

                                <div class="hero-subtitle fadeInDown-2">
                                    {{ $slide->description }}
                                </div>
                                <div class="hero-action-btn fadeInDown-4">
                                    <a href="{{ $slide->link }}" class="big le-button ">{{ $slide->button }}</a>
                                </div>
                            </div><!-- /.caption -->
                        </div>
                    </div>
                </div><!-- /.container -->
            </div><!-- /.item -->
        @endforeach

    </div><!-- /.owl-carousel -->

    <!-- ========================================= SECTION – HERO : END ========================================= -->

</div><!-- /.home-v1-slider -->