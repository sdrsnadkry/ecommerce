@php
use App\Product;
@endphp
<form action="{{url('/products-filter')}}" method="POST"> {{csrf_field()}}
    @if (!empty($url))
    <input type="hidden" name="url" value=" {{$url}}">
    @endif
    <div class="left-sidebar">
        <h2>Categories</h2>
        <div class="panel-group category-products" id="accordian">
            @foreach ($categories as $cat)
            <div class="panel panel-default">
                @if($cat->status=='1')
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{$cat->name}}
                        </a>
                    </h4>
                </div>
                <div id="{{$cat->id}}" class="panel-collapse collapse">
                    <div class="panel-body">
                        <ul>
                            @foreach ($cat->categories as $subcat)
                            @php
                            $productCount = Product::productCount($subcat->id);
                            @endphp
                            @if($subcat->status=='1')
                            <li><a href="{{asset('/products/'.$subcat->url)}}">{{$subcat->name}}</a> [ {{$productCount}} ] </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        <!--/filter-products-->
        @if (!empty($url))
        <h2>Filters</h2>
        <div class="panel-group category-products" id="accordian">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian2" href="#accordian2">Color
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{-- {{$cat->name}} --}}
                        </a>
                    </h4>
                </div>
                <div id="accordian2" class="panel-collapse collapse">
                    <div class="panel-body">
                        @foreach ($colorArray as $color)
                        @php
                        if (!empty($_GET['color'])){
                        $colorArr = explode('-',$_GET['color']);
                        if (in_array($color,$colorArr)){
                        $colorcheck = "checked";
                        }else{
                        $colorcheck = "";
                        }
                        }else{
                        $colorcheck = "";
                        }
                        @endphp
                        <ul>
                            <input type="checkbox" name="colorFilter[]" onchange="javascript:this.form.submit()" value="{{$color}}" id="{{$color}}" {{$colorcheck}}>
                            </span>{{$color}}</a>
                        </ul>
                        @endforeach
                    </div>
                </div>
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordian3" href="#accordian3">Sizes
                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                            {{-- {{$cat->name}} --}}
                        </a>
                    </h4>
                </div>
                <div id="accordian3" class="panel-collapse collapse">
                    <div class="panel-body">
                        @foreach ($sizesArray as $size)
                        @php
                        if (!empty($_GET['size'])){
                        $sizeArr = explode('-',$_GET['size']);
                        if (in_array($size,$sizeArr)){
                        $sizecheck = "checked";
                        }else{
                        $sizecheck = "";
                        }
                        }else{
                        $sizecheck = "";
                        }
                        @endphp
                        <ul>
                            <input type="checkbox" name="sizeFilter[]" onchange="javascript:this.form.submit()" value="{{$size}}" id="{{$size}}" {{$sizecheck}}>
                            </span>{{$size}}</a>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</form>
