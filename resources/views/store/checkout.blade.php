@extends('store.layout.master')

@section('body-class', 'page home page-template-default')

@section('content')
    <nav class="navbar navbar-primary navbar-full">
        <div class="container">
            <ul class="nav navbar-nav departments-menu animate-dropdown">
                <li class="nav-item dropdown ">

                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="departments-menu-toggle" >Shop by Department</a>
                    <ul id="menu-vertical-menu" class="dropdown-menu yamm departments-menu-dropdown">
                        <li class="highlight menu-item animate-dropdown active"><a title="Value of the Day" href="product-category.html">Value of the Day</a></li>
                        <li class="highlight menu-item animate-dropdown"><a title="Top 100 Offers" href="home-v3.html">Top 100 Offers</a></li>
                        <li class="highlight menu-item animate-dropdown"><a title="New Arrivals" href="home-v3-full-color-background.html">New Arrivals</a></li>

                        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2584 dropdown">
                            <a title="Computers &amp; Accessories" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Computers &#038; Accessories</a>
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">
                                        <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="assets/images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Computers &amp; Accessories</li>
                                                                    <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                    <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                    <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                    <li><a href="#">Printers &amp; Ink</a></li>
                                                                    <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                    <li><a href="#">Computer Accessories</a></li>
                                                                    <li><a href="#">Software</a></li>
                                                                    <li class="nav-divider"></li>
                                                                    <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Office &amp; Stationery</li>
                                                                    <li><a href="#">All Office &amp; Stationery</a></li>
                                                                    <li><a href="#">Pens &amp; Writing</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2585 dropdown">
                            <a title="Cameras, Audio &amp; Video" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Cameras, Audio &#038; Video</a>
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">
                                        <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="assets/images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Computers &amp; Accessories</li>
                                                                    <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                    <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                    <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                    <li><a href="#">Printers &amp; Ink</a></li>
                                                                    <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                    <li><a href="#">Computer Accessories</a></li>
                                                                    <li><a href="#">Software</a></li>
                                                                    <li class="nav-divider"></li>
                                                                    <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Office &amp; Stationery</li>
                                                                    <li><a href="#">All Office &amp; Stationery</a></li>
                                                                    <li><a href="#">Pens &amp; Writing</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2586 dropdown">
                            <a title="Mobiles &amp; Tablets" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Mobiles &#038; Tablets</a>
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">
                                        <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="assets/images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Computers &amp; Accessories</li>
                                                                    <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                    <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                    <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                    <li><a href="#">Printers &amp; Ink</a></li>
                                                                    <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                    <li><a href="#">Computer Accessories</a></li>
                                                                    <li><a href="#">Software</a></li>
                                                                    <li class="nav-divider"></li>
                                                                    <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Office &amp; Stationery</li>
                                                                    <li><a href="#">All Office &amp; Stationery</a></li>
                                                                    <li><a href="#">Pens &amp; Writing</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2587 dropdown">
                            <a title="Movies, Music &amp; Video Games" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Movies, Music &#038; Video Games</a>
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">
                                        <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="assets/images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Computers &amp; Accessories</li>
                                                                    <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                    <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                    <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                    <li><a href="#">Printers &amp; Ink</a></li>
                                                                    <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                    <li><a href="#">Computer Accessories</a></li>
                                                                    <li><a href="#">Software</a></li>
                                                                    <li class="nav-divider"></li>
                                                                    <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Office &amp; Stationery</li>
                                                                    <li><a href="#">All Office &amp; Stationery</a></li>
                                                                    <li><a href="#">Pens &amp; Writing</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2588 dropdown">
                            <a title="TV &amp; Audio" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">TV &#038; Audio</a>
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">
                                        <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="assets/images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Computers &amp; Accessories</li>
                                                                    <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                    <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                    <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                    <li><a href="#">Printers &amp; Ink</a></li>
                                                                    <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                    <li><a href="#">Computer Accessories</a></li>
                                                                    <li><a href="#">Software</a></li>
                                                                    <li class="nav-divider"></li>
                                                                    <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Office &amp; Stationery</li>
                                                                    <li><a href="#">All Office &amp; Stationery</a></li>
                                                                    <li><a href="#">Pens &amp; Writing</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2589 dropdown">

                            <a title="Watches &amp; Eyewear" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Watches &#038; Eyewear</a>
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">
                                        <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="assets/images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Computers &amp; Accessories</li>
                                                                    <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                    <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                    <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                    <li><a href="#">Printers &amp; Ink</a></li>
                                                                    <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                    <li><a href="#">Computer Accessories</a></li>
                                                                    <li><a href="#">Software</a></li>
                                                                    <li class="nav-divider"></li>
                                                                    <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Office &amp; Stationery</li>
                                                                    <li><a href="#">All Office &amp; Stationery</a></li>
                                                                    <li><a href="#">Pens &amp; Writing</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>


                        <li class="yamm-tfw menu-item menu-item-has-children animate-dropdown menu-item-2590 dropdown">

                            <a title="Car, Motorbike &amp; Industrial" href="product-category.html" data-toggle="dropdown" class="dropdown-toggle" aria-haspopup="true">Car, Motorbike &#038; Industrial</a>
                            <ul role="menu" class=" dropdown-menu">
                                <li class="menu-item animate-dropdown menu-item-object-static_block">
                                    <div class="yamm-content">
                                        <div class="vc_row row wpb_row vc_row-fluid bg-yamm-content bg-yamm-content-bottom bg-yamm-content-right">
                                            <div class="wpb_column vc_column_container vc_col-sm-12 col-sm-12">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_single_image wpb_content_element vc_align_left">
                                                            <figure class="wpb_wrapper vc_figure">
                                                                <div class="vc_single_image-wrapper   vc_box_border_grey"><img width="540" height="460" src="assets/images/megamenu-2.png" class="vc_single_image-img attachment-full" alt="megamenu-2"/></div>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="vc_row row wpb_row vc_row-fluid">
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Computers &amp; Accessories</li>
                                                                    <li><a href="#">All Computers &amp; Accessories</a></li>
                                                                    <li><a href="#">Laptops, Desktops &amp; Monitors</a></li>
                                                                    <li><a href="#">Pen Drives, Hard Drives &amp; Memory Cards</a></li>
                                                                    <li><a href="#">Printers &amp; Ink</a></li>
                                                                    <li><a href="#">Networking &amp; Internet Devices</a></li>
                                                                    <li><a href="#">Computer Accessories</a></li>
                                                                    <li><a href="#">Software</a></li>
                                                                    <li class="nav-divider"></li>
                                                                    <li><a href="#"><span class="nav-text">All Electronics</span><span class="nav-subtext">Discover more products</span></a></li>
                                                                </ul>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wpb_column vc_column_container vc_col-sm-6 col-sm-6">
                                                <div class="vc_column-inner ">
                                                    <div class="wpb_wrapper">
                                                        <div class="wpb_text_column wpb_content_element ">
                                                            <div class="wpb_wrapper">
                                                                <ul>
                                                                    <li class="nav-title">Office &amp; Stationery</li>
                                                                    <li><a href="#">All Office &amp; Stationery</a></li>
                                                                    <li><a href="#">Pens &amp; Writing</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li class="menu-item animate-dropdown"><a title="Accessories" href="product-category.html">Accessories</a></li>
                        <li class="menu-item animate-dropdown"><a title="Printers &amp; Ink" href="product-category.html">Printers &#038; Ink</a></li>
                        <li class="menu-item animate-dropdown"><a title="Software" href="product-category.html">Software</a></li>
                        <li class="menu-item animate-dropdown"><a title="Office Supplies" href="product-category.html">Office Supplies</a></li>
                        <li class="menu-item animate-dropdown"><a title="Computer Components" href="product-category.html">Computer Components</a></li>
                        <li class="menu-item animate-dropdown"><a title="Car Electronic &amp; GPS" href="product-category.html">Car Electronic &#038; GPS</a></li>
                        <li class="menu-item animate-dropdown"><a title="Accessories" href="product-category.html">Accessories</a></li>
                        <li class="menu-item animate-dropdown"><a title="Printers &amp; Ink" href="product-category.html">Printers &#038; Ink</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-search" method="get" action="/">
                <label class="sr-only screen-reader-text" for="search">Search for:</label>
                <div class="input-group">
                    <input type="text" id="search" class="form-control search-field" dir="ltr" value="" name="s" placeholder="Search for products" />
                    <div class="input-group-addon search-categories">
                        <select name='product_cat' id='product_cat' class='postform resizeselect' >
                            <option value='0' selected='selected'>All Categories</option>
                            <option class="level-0" value="laptops-laptops-computers">Laptops</option>
                            <option class="level-0" value="ultrabooks-laptops-computers">Ultrabooks</option>
                            <option class="level-0" value="mac-computers-laptops">Mac Computers</option>
                            <option class="level-0" value="all-in-one-laptops-computers">All in One</option>
                            <option class="level-0" value="servers">Servers</option>
                            <option class="level-0" value="peripherals">Peripherals</option>
                            <option class="level-0" value="gaming-laptops-computers">Gaming</option>
                            <option class="level-0" value="accessories-laptops-computers">Accessories</option>
                            <option class="level-0" value="audio-speakers">Audio Speakers</option>
                            <option class="level-0" value="headphones">Headphones</option>
                            <option class="level-0" value="computer-cases">Computer Cases</option>
                            <option class="level-0" value="printers">Printers</option>
                            <option class="level-0" value="cameras">Cameras</option>
                            <option class="level-0" value="smartphones">Smartphones</option>
                            <option class="level-0" value="game-consoles">Game Consoles</option>
                            <option class="level-0" value="power-banks">Power Banks</option>
                            <option class="level-0" value="smartwatches">Smartwatches</option>
                            <option class="level-0" value="chargers">Chargers</option>
                            <option class="level-0" value="cases">Cases</option>
                            <option class="level-0" value="headphone-accessories">Headphone Accessories</option>
                            <option class="level-0" value="headphone-cases">Headphone Cases</option>
                            <option class="level-0" value="tablets">Tablets</option>
                            <option class="level-0" value="tvs">TVs</option>
                            <option class="level-0" value="wearables">Wearables</option>
                            <option class="level-0" value="pendrives">Pendrives</option>
                        </select>
                    </div>
                    <div class="input-group-btn">
                        <input type="hidden" id="search-param" name="post_type" value="product" />
                        <button type="submit" class="btn btn-secondary"><i class="ec ec-search"></i></button>
                    </div>
                </div>
            </form>

            <ul class="navbar-mini-cart navbar-nav animate-dropdown nav pull-right flip">
                <li class="nav-item dropdown">
                    <a href="cart.html" class="nav-link" data-toggle="dropdown">
                        <i class="ec ec-shopping-bag"></i>
                        <span class="cart-items-count count">4</span>
                        <span class="cart-items-total-price total-price"><span class="amount">&#36;1,215.00</span></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-mini-cart">
                        <li>
                            <div class="widget_shopping_cart_content">

                                <ul class="cart_list product_list_widget ">


                                    <li class="mini_cart_item">
                                        <a title="Remove this item" class="remove" href="#">×</a>
                                        <a href="single-product.html">
                                            <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="assets/images/products/mini-cart1.jpg" alt="">White lumia 9001&nbsp;
                                        </a>

                                        <span class="quantity">2 × <span class="amount">£150.00</span></span>
                                    </li>


                                    <li class="mini_cart_item">
                                        <a title="Remove this item" class="remove" href="#">×</a>
                                        <a href="single-product.html">
                                            <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="assets/images/products/mini-cart2.jpg" alt="">PlayStation 4&nbsp;
                                        </a>

                                        <span class="quantity">1 × <span class="amount">£399.99</span></span>
                                    </li>

                                    <li class="mini_cart_item">
                                        <a data-product_sku="" data-product_id="34" title="Remove this item" class="remove" href="#">×</a>
                                        <a href="single-product.html">
                                        <img class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image" src="assets/images/products/mini-cart3.jpg" alt="">POV Action Cam HDR-AS100V&nbsp;

                                        </a>

                                        <span class="quantity">1 × <span class="amount">£269.99</span></span>
                                    </li>


                                </ul><!-- end product list -->


                                <p class="total"><strong>Subtotal:</strong> <span class="amount">£969.98</span></p>


                                <p class="buttons">
                                    <a class="button wc-forward" href="cart.html">View Cart</a>
                                    <a class="button checkout wc-forward" href="checkout.html">Checkout</a>
                                </p>


                            </div>
                        </li>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-wishlist nav navbar-nav pull-right flip">
                <li class="nav-item">
                    <a href="wishlist.html" class="nav-link"><i class="ec ec-favorites"></i></a>
                </li>
            </ul>
            <ul class="navbar-compare nav navbar-nav pull-right flip">
                <li class="nav-item">
                    <a href="compare.html" class="nav-link"><i class="ec ec-compare"></i></a>
                </li>
            </ul>
        </div>
    </nav>

    <div id="content" class="site-content" tabindex="-1">
        <div class="container">

            <nav class="woocommerce-breadcrumb"><a href="home.html">Home</a><span class="delimiter"><i class="fa fa-angle-right"></i></span>Checkout</nav>

            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <article class="page type-page status-publish hentry">
                        <header class="entry-header"><h1 itemprop="name" class="entry-title">Checkout</h1></header><!-- .entry-header -->

                        <form enctype="multipart/form-data" action="#" class="checkout woocommerce-checkout" method="post" name="checkout">
                            <div id="customer_details" class="col2-set">
                                <div class="col-1">
                                    <div class="woocommerce-billing-fields">

                                        <h3>Billing Details</h3>

                                        <p id="billing_first_name_field" class="form-row form-row form-row-first validate-required"><label class="" for="billing_first_name">First Name <abbr title="required" class="required">*</abbr></label><input type="text" value="" placeholder="" id="billing_first_name" name="billing_first_name" class="input-text "></p>

                                        <p id="billing_last_name_field" class="form-row form-row form-row-last validate-required"><label class="" for="billing_last_name">Last Name <abbr title="required" class="required">*</abbr></label><input type="text" value="" placeholder="" id="billing_last_name" name="billing_last_name" class="input-text "></p><div class="clear"></div>

                                        <p id="billing_company_field" class="form-row form-row form-row-wide"><label class="" for="billing_company">Company Name</label><input type="text" value="" placeholder="" id="billing_company" name="billing_company" class="input-text "></p>

                                        <p id="billing_email_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_email">Email Address <abbr title="required" class="required">*</abbr></label><input type="email" value="" placeholder="" id="billing_email" name="billing_email" class="input-text "></p>

                                        <p id="billing_phone_field" class="form-row form-row form-row-last validate-required validate-phone"><label class="" for="billing_phone">Phone <abbr title="required" class="required">*</abbr></label><input type="tel" value="" placeholder="" id="billing_phone" name="billing_phone" class="input-text "></p><div class="clear"></div>

                                        <p id="billing_country_field" class="form-row form-row form-row-wide validate-required validate-email"><label class="" for="billing_country">Country <abbr title="required" class="required">*</abbr></label><input type="text" value="" placeholder="" id="billing_country" name="billing_phone" class="input-text "></p><div class="clear"></div>

                                        <p id="billing_address_1_field" class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_address_1">Address <abbr title="required" class="required">*</abbr></label><input type="text" value="" placeholder="Street address" id="billing_address_1" name="billing_address_1" class="input-text "></p>

                                        <p id="billing_address_2_field" class="form-row form-row form-row-wide address-field"><input type="text" value="" placeholder="Apartment, suite, unit etc. (optional)" id="billing_address_2" name="billing_address_2" class="input-text "></p>

                                        <p id="billing_city_field" class="form-row form-row form-row-wide address-field validate-required" data-o_class="form-row form-row form-row-wide address-field validate-required"><label class="" for="billing_city">Town / City <abbr title="required" class="required">*</abbr></label><input type="text" value="" placeholder="" id="billing_city" name="billing_city" class="input-text "></p>

                                        <p id="billing_state_field" class="form-row form-row form-row-first validate-required validate-email"><label class="" for="billing_state">State / County <abbr title="required" class="required">*</abbr></label><input type="text" value="" placeholder="" id="billing_state" name="billing_phone" class="input-text "></p>

                                        <p id="billing_postcode_field" class="form-row form-row form-row-last address-field validate-postcode validate-required" data-o_class="form-row form-row form-row-last address-field validate-required validate-postcode"><label class="" for="billing_postcode">Postcode / ZIP <abbr title="required" class="required">*</abbr></label><input type="text" value="" placeholder="" id="billing_postcode" name="billing_postcode" class="input-text "></p>

                                        <div class="clear"></div>

                                        <p class="form-row form-row-wide create-account"><input type="checkbox" value="1" name="createaccount" id="createaccount" class="input-checkbox"> <label class="checkbox" for="createaccount">Create an account?</label></p>

                                    </div>
                                </div>

                                <div class="col-2">
                                    <h3>Shipping Details</h3>
                                    <div class="woocommerce-shipping-fields">
                                        <h3 id="ship-to-different-address">
                                            <label class="checkbox" for="ship-to-different-address-checkbox">Ship to a different address?</label>
                                            <input type="checkbox" value="1" name="ship_to_different_address" class="input-checkbox" id="ship-to-different-address-checkbox">
                                        </h3>
                                
                                        <p id="order_comments_field" class="form-row form-row notes"><label class="" for="order_comments">Order Notes</label><textarea cols="5" rows="2" placeholder="Notes about your order, e.g. special notes for delivery." id="order_comments" class="input-text " name="order_comments"></textarea></p>
                                    </div>
                                </div>
                            </div>

                            <h3 id="order_review_heading">Your order</h3>

                            <div class="woocommerce-checkout-review-order" id="order_review">
                                <table class="shop_table woocommerce-checkout-review-order-table">
                                    <thead>
                                        <tr>
                                            <th class="product-name">Product</th>
                                            <th class="product-total">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                Wireless Audio System Multiroom 360&nbsp;
                                                <strong class="product-quantity">× 1</strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount">$1,999.00</span>
                                            </td>
                                        </tr>
                                        <tr class="cart_item">
                                            <td class="product-name">
                                                Tablet White EliteBook  Revolve 810 G2&nbsp;
                                                <strong class="product-quantity">× 1</strong>
                                            </td>
                                            <td class="product-total">
                                                <span class="amount">$1,300.00</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>

                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="amount">$3,299.00</span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td data-title="Shipping">Flat Rate: <span class="amount">$300.00</span> <input type="hidden" class="shipping_method" value="international_delivery" id="shipping_method_0" data-index="0" name="shipping_method[0]"></td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong><span class="amount">$3,599.00</span></strong> </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div class="woocommerce-checkout-payment" id="payment">
                                    <ul class="wc_payment_methods payment_methods methods">
                                        <li class="wc_payment_method payment_method_bacs">
                                            <input type="radio" data-order_button_text="" checked="checked" value="bacs" name="payment_method" class="input-radio" id="payment_method_bacs">
                                            <label for="payment_method_bacs">Direct Bank Transfer</label>
                                            <div class="payment_box payment_method_bacs">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                            </div>
                                        </li>
                                        <li class="wc_payment_method payment_method_cheque">
                                            <input type="radio" data-order_button_text="" value="cheque" name="payment_method" class="input-radio" id="payment_method_cheque">
                                            <label for="payment_method_cheque">Cheque Payment 	</label>
                                            <div style="display:none;" class="payment_box payment_method_cheque">
                                                <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                            </div>
                                        </li>
                                        <li class="wc_payment_method payment_method_cod">
                                            <input type="radio" data-order_button_text="" value="cod" name="payment_method" class="input-radio" id="payment_method_cod">

                                            <label for="payment_method_cod">Cash on Delivery</label>
                                            <div style="display:none;" class="payment_box payment_method_cod">
                                                <p>Pay with cash upon delivery.</p>
                                            </div>
                                        </li>
                                        <li class="wc_payment_method payment_method_paypal">
                                            <input type="radio" data-order_button_text="Proceed to PayPal" value="paypal" name="payment_method" class="input-radio" id="payment_method_paypal">

                                            <label for="payment_method_paypal">PayPal <img alt="PayPal Acceptance Mark" src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg"><a title="What is PayPal?" onclick="javascript:window.open('https://www.paypal.com/us/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" class="about_paypal" href="https://www.paypal.com/us/webapps/mpp/paypal-popup">What is PayPal?</a></label>
                                            <div style="display:none;" class="payment_box payment_method_paypal">
                                                <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                            </div>
                                        </li>
                                    </ul>
                                    <div class="form-row place-order">

                                        <p class="form-row terms wc-terms-and-conditions">
                                            <input type="checkbox" id="terms" name="terms" class="input-checkbox">
                                            <label class="checkbox" for="terms">I’ve read and accept the <a target="_blank" href="terms-and-conditions.html">terms &amp; conditions</a> <span class="required">*</span></label>
                                            <input type="hidden" value="1" name="terms-field">
                                        </p>

                                        <input type="submit" data-value="Place order" value="Place order" class="button alt">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </article>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .container -->
    </div><!-- #content -->
@endsection