<nav class="navbar navbar-expand-lg navbar-light bg-light mt-0 pt-0 mb-0 pb-0">

        <div class="row col-lg-12 container-fluid">
            <div class="col-lg-2">
                <a class="navbar-brand" href="{{ route('index') }}"><img src="{{asset('logo.png')}}" alt="YOWOMART" class="logo "></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent, #navbarNav2" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="col-lg-7">
                <form class="d-flex mt-4" method="get" action="{{ route('find', ['category' => 'all']) }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Find Everything Want To You...!">
                        <button type="submit" class="btn @if(isset($primary_button_color)) {{ str_replace('btn-', 'btn-outline-', $primary_button_color) }} @else btn-outline-warning @endif"><i class="fas fa-search"></i> Search</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 p-0">
                <div class="collapse navbar-collapse float-end" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        @if(session()->has('auth_user') and session()->get('auth_user') != null)
                        <li class="nav-item me-3 fs-6">
                            <i class="fas fa-address-card"></i>
                            <span><a class="text-decoration-none text-decoration-none text-dark" href="{{ route('my_account', ['state' => 'my_account']) }}" >My&nbsp;Account</a></span>
                        </li>
                        @else
                            <li class="nav-item me-3 fs-6">
                                <i class="fas fa-sign-in-alt"></i>
                                <span><a class="text-decoration-none text-black" href="{{ route('login') }}" >Login</a></span>
                            </li>

                            <li class="nav-item me-3 fs-6">
                                <i class="fas fa-user-plus"></i>
                                <span><a class="text-decoration-none text-black" href="{{ route('register') }}" >Register</a></span>
                            </li>
                        @endif
                        <li class="nav-item me-3 fs-6">
                            <a class="text-decoration-none @if(isset($ternary_button_color)) {{ str_replace('btn-', 'text-', $ternary_button_color) }} @else text-danger @endif" href="{{ route('my_account', ['state' => 'wishlist']) }}" ><i class="fas fa-heart fs-4"></i></a>
                        </li>
                        <li class="nav-item me-3 fs-6">
                            <span><a class="text-decoration-none text-black" href="{{ route('cart') }}" ><i class="fas fa-shopping-cart"></i> My Cart</a></span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav2">
            <ul class="navbar-nav">
                @if(isset($categories) && $categories != null)
                    <li class="nav-item d-md-none d-sm-none d-lg-block">
                        <div class="dropdown">
                            <a class="btn btn-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i>&nbsp;Categories
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="width: 200px;">
                                @foreach($categories as $main_category)
                                    @if($main_category->parent_id == 0)
                                        <?php
                                            $list = [];

                                        ?>
                                    @foreach($categories as $sub_category)
                                        @if($sub_category->parent_id == $main_category->category_id)
                                            <?php
                                                $item = [
                                                    'category_id' => $sub_category->category_id,
                                                    'name' => $sub_category->name,
                                                ];
                                                array_push($list, $item);
                                            ?>
                                        @endif
                                    @endforeach
                                        <?php $list = json_encode($list) ?>
                                        <li onmouseover="showSubCategories('{{ $main_category->category_id }}', '{{ $main_category->name }}', '{{$list}}')" class="dropdown-item dropend">{{ ucwords(str_replace('_', ' ', $main_category->name)) }}</li>
                                        <ul class="dropdown-menu dropend " id="sub_categories_menu" style="margin-left: 199px;">

                                        </ul>
                                    @endif
                                @endforeach
                            </ul>
                        </div>

                </li>

                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('index') }}"><i class="fas fa-home"></i>&nbsp;Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-target="#track_order" data-bs-toggle="modal" role="button"><i class="fas fa-shipping-fast"></i>&nbsp;Track order</a>
                </li>
                    @if(isset($shop_email)|| isset($shop_mobile))
                <li class="nav-item">
                    <a class="nav-link disabled"> @if(isset($shop_mobile))<i class="fas fa-headset"></i>&nbsp;{{ $shop_mobile }} @endif @if(isset($shop_email))&nbsp;<i class="fas fa-paper-plane"></i>&nbsp;{{ $shop_email }} @endif</a>
                </li>
                        @endif
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="track_order" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Track Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('track-order')}}" method="post">
                    @csrf
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email Address">
                    <input type="text" name="order_id" class="form-control mb-3" placeholder="Order ID">
                    <input type="submit" value="Track Order" class="col-12 btn btn-warning">
                </form>
            </div>
        </div>
    </div>
</div>
