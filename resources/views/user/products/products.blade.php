@extends('user.layouts.app', ['title' => 'Products'])

@section('css')
<!-- <style>
    .dropdown-toggle::after {
        display: inline-block;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: .3em solid;
        border-right: .3em solid transparent;
        border-bottom: 0;
        border-left: .3em solid transparent;
    }

    .dropdown-toggle[aria-expanded="true"]::after {
        display: inline-block;
        margin-left: .255em;
        vertical-align: .255em;
        content: "";
        border-top: 0;
        border-right: .3em solid transparent;
        border-bottom: .3em solid;
        border-left: .3em solid transparent;
    }

    .dropdown-submenu {
        position: relative;
    }

    .dropdown-submenu>.dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -6px;
        margin-left: -1px;
        -webkit-border-radius: 0 6px 6px 6px;
        -moz-border-radius: 0 6px 6px 6px;
        border-radius: 0 6px 6px 6px;
        font-size: 15px;
    }

    .dropdown-submenu:hover>.dropdown-menu {
        display: block;
    }

    .dropdown-submenu>a:after {
        display: block;
        float: right;
        width: 0;
        height: 0;
        margin-top: 5px;
        margin-right: -10px;
        border-color: transparent;
        border-left-color: #ccc;
        border-style: solid;
        border-width: 5px 0 5px 5px;
        content: " ";
    }

    .dropdown-submenu:hover>a:after {
        border-left-color: #fff;
    }

    .dropdown-submenu.pull-left {
        float: none;
    }

    .dropdown-submenu.pull-left>.dropdown-menu {
        left: -100%;
        margin-left: 10px;
        -webkit-border-radius: 6px 0 6px 6px;
        -moz-border-radius: 6px 0 6px 6px;
        border-radius: 6px 0 6px 6px;
    }

    .navbar-nav>li.active>a,
    .navbar-nav>li.active>a:hover,
    .navbar-nav>li.active>a:focus {
        background-color: lightblue;
        color: blue;
        font-weight: 500;
    }
</style> -->
<!-- <style>
    /* Style for the parent li element */
.treeview {
  position: relative;
  display: block;
  margin-bottom: 10px;
  font-size: 20px;
  color: #333;
  margin-left: 18px;
}

/* Style for the arrow icon */
.treeview i {
  position: absolute;
  top: 50%;
  right: 10px;
  font-size: 20px;
  color: #333;
}

.treeview.active > i {
  transform: translateY(-50%) rotate(180deg);
}


</style> -->

@endsection

@section('content')

<!-- Start Content-->
<div class="container-fluid">
    <x-alert></x-alert>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">{{env('APP_NAME')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{__('user.products')}}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{__('user.products')}}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
        @include('user.products.category-bar')


        </div>
        <div class="col-md-10">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <input type="search" class="form-control" id="search-input" placeholder="Search..." value="@if($search_name){{$search_name}}@endif" />
                        </div>

                    </div>
                    @if(count($products)>0)
                    <div class="row mt-2">
                        @foreach($products as $product)
                        <div class="col-sm-6 col-md-4 col-xl-2 col-lg-3">
                            <a href="{{route('user.products.show',['id'=>$product->id])}}" class="text-dark">
                                <div class="card-box product-box">

                                    <div class="bg-light">

                                        @if(count($product['productImages'])!=0)
                                        <img src="{{asset('storage/'.$product['productImages'][0]['url'])}}" style="object-fit: cover" alt="OOps" class="img-fluid">
                                        @else
                                        <img src="{{\App\Models\Product::getPlaceholderImage()}}" style="object-fit: cover" alt="OOps" class="img-fluid">
                                        @endif

                                    </div>

                                    <div class="product-info">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="font-16 mt-0 sp-line-1">{{$product->name}}</h5>
                                                <div class="">
                                                    @for($i=1;$i<6;$i++) @if($product->rating >= $i)
                                                        <i class="fa fa-star text-success"></i>
                                                        @else
                                                        <i class="fa fa-star text-light"></i>
                                                        @endif
                                                        @endfor
                                                        <a class="text-body" href="{{route('user.product.reviews.show',['id'=>$product->id])}}"> ({{$product->total_rating}} {{__('user.reviews')}})</a>
                                                </div>
                                                <h5 class="mt-2"><span class="text-muted"> {{count($product['productItems'])}} {{__('user.types_of_items_available')}}</span>
                                                </h5>

                                                <form action="{{route('user.carts.store')}}" method="post" class="form mb-3 mt-3">
                                                    @csrf
                                                    <!-- <label class="my-1 mr-2" for="quantityinput">Products</label> -->
                                                    <div class="mt-2">


                                                        <select name="product_item_id" class="form-control align-self-center">
                                                            @foreach($product->productItems as $productItem)

                                                            <option value="{{$productItem->id}}"> {{\App\Helpers\ProductUtil::getProductItemFeatures($productItem)}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>

                                                    <div>
                                                        <!-- <button id="favoriteBtn" type="button" class="btn btn-outline-primary mr-2"><i
                                                class="mdi mdi-18px @if($product->is_favorite) mdi-heart @else mdi-heart-outline @endif "></i></button> -->


                                                        <button type="submit" class="btn btn-success waves-effect waves-light mt-1">
                                                            <span class="btn-label"><i class="mdi mdi-cart"></i></span>Add to cart
                                                        </button>
                                                    </div>

                                                </form>
                                            </div>

                                        </div> <!-- end row -->
                                    </div> <!-- end product info-->
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-center h4 font-weight-medium">{{__('user.there_is_no_product_with_these_filter')}}
                    </p>
                    @endif
                </div>
            </div> <!-- end card-body-->
            <!-- end card-->

        </div>
    </div>

    <div class="float-right">
        {{$products->links()}}
    </div>
</div> <!-- container -->

@endsection

@section('script')

<script>
    const searchInput = document.getElementById('search-input');
    searchInput.addEventListener('keypress', function(e) {
        if (e.code === "Enter") {

            insertParam('name', searchInput.value);
            {
                {
                    --
                    const form = document.createElement('form');
                    --
                }
            } {
                {
                    // --form.action = '';  {{(' user.products.filter ')}}
                    --
                }
            } {
                {
                    --form.method = 'post';
                    --
                }
            } {
                {
                    --
                    const inputName = document.createElement('input');
                    --
                }
            } {
                {
                    --inputName.type = "hidden";
                    --
                }
            } {
                {
                    --inputName.name = "name";
                    --
                }
            } {
                {
                    --inputName.value = searchInput.value;
                    --
                }
            }


            {
                {
                    --
                    const inputToken = document.createElement('input');
                    --
                }
            } {
                {
                    --inputToken.type = "hidden";
                    --
                }
            } {
                {
                    --inputToken.name = "_token";
                    --
                }
            } {
                {
                    --inputToken.value = "{{csrf_token()}}";
                    --
                }
            }


            {
                {
                    --form.appendChild(inputName);
                    --
                }
            } {
                {
                    --form.appendChild(inputToken);
                    --
                }
            } {
                {
                    --document.getElementsByClassName('container-fluid')[0].append(form);
                    --
                }
            } {
                {
                    --form.submit();
                    --
                }
            } {
                {
                    --form.remove();
                    --
                }
            }
        }
    });


    function insertParam(key, value) {
        key = escape(key);
        value = escape(value);

        var kvp = document.location.search.substr(1).split('&');
        if (kvp == '') {
            document.location.search = '?' + key + '=' + value;
        } else {

            var i = kvp.length;
            var x;
            while (i--) {
                x = kvp[i].split('=');

                if (x[0] == key) {
                    x[1] = value;
                    kvp[i] = x.join('=');
                    break;
                }
            }

            if (i < 0) {
                kvp[kvp.length] = [key, value].join('=');
            }

            //this will reload the page, it's likely better to store this until finished
            document.location.search = kvp.join('&');
        }
    }
</script>


@endsection