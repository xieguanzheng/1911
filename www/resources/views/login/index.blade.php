@extends('lyouds.all')
@section('title',"登陆")
@section('content')

<!-- menu -->
<div class="slider">

    <ul class="slides">
        <li>
            <img src="/img/slide1.jpg" alt="">
            <div class="caption slider-content  center-align">
                <h2>WELCOME TO MSTORE</h2>
                <h4>Lorem ipsum dolor sit amet.</h4>
                <a href="goods" class="btn button-default">SHOP NOW</a>
            </div>
        </li>
        <li>
            <img src="/img/slide2.jpg" alt="">
            <div class="caption slider-content center-align">
                <h2>JACKETS BUSINESS</h2>
                <h4>Lorem ipsum dolor sit amet.</h4>
                <a href="goods" class="btn button-default">SHOP NOW</a>
            </div>
        </li>
        <li>
            <img src="/img/slide3.jpg" alt="">
            <div class="caption slider-content center-align">
                <h2>FASHION SHOP</h2>
                <h4>Lorem ipsum dolor sit amet.</h4>
                <a href="goods" class="btn button-default">SHOP NOW</a>
            </div>
        </li>
    </ul>

</div>
<!-- end slider -->

<!-- features -->
<div class="features section">
    <div class="container">
        <div class="row">
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-car"></i>
                    </div>
                    <h6>Free Shipping</h6>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <h6>Money Back</h6>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
        </div>
        <div class="row margin-bottom-0">
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-lock"></i>
                    </div>
                    <h6>Secure Payment</h6>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
            <div class="col s6">
                <div class="content">
                    <div class="icon">
                        <i class="fa fa-support"></i>
                    </div>
                    <h6>24/7 Support</h6>
                    <p>Lorem ipsum dolor sit amet consectetur</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end features -->

<!-- quote -->
<div class="section quote">
    <div class="container">
        <h4>FASHION UP TO 50% OFF</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid ducimus illo hic iure eveniet</p>
    </div>
</div>
<!-- end quote -->

<!-- product -->
<div class="section product">
    <div class="container">
        <div class="section-head">
            <h4>NEW PRODUCT</h4>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
        </div>

        <div class="row">
            @foreach($zuixi as $k=>$v)
                <div class="col s6">
                    <div class="content">
                        <img src="{{env("UPLOADS_URL")}}{{$v->goods_img}}" alt="">
                        <a href="{{'/index/detail/'.$v->goods_id}}">{{$v->goods_name}}</a>
                        <div class="price">
                            ${{$v->shop_price}} <span>$28</span>
                        </div>
                        <a href="{{'/index/cart/'.$v->goods_id}}" class="btn button-default">加入购物车</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
</div>
<!-- end product -->

<!-- promo -->
<div class="promo section">
    <div class="container">
        <div class="content">
            <h4>PRODUCT BUNDLE</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
            <a href="goods" class="btn button-default">SHOP NOW</a>
        </div>
    </div>
</div>
<!-- end promo -->

<!-- product -->
<div class="section product">
    <div class="container">
        <div class="section-head">
            <h4>TOP PRODUCT</h4>
            <div class="divider-top"></div>
            <div class="divider-bottom"></div>
        </div>

        <div class="row">
                    @foreach($remai as $k=>$vv)
                        <div class="col s6">
                            <div class="content">
                                <img src="{{env("UPLOADS_URL")}}{{$vv->goods_img}}" alt="">
                                <h6><a href="{{url('/user/detail')}}" id="but">{{$vv->goods_name}}</a></h6>
                                <div class="price">
                                    ${{$vv->shop_price}} <span>$28</span>
                                </div>
                                <a href="{{'/index/cart/'.$vv->goods_id}}" class="btn button-default">加入购物车</a>
                            </div>
                        </div>
            @endforeach
        </div>
</div>
    </div>
<!-- end product -->

<!-- loader -->
<div id="fakeLoader"></div>
<!-- end loader -->

@endsection