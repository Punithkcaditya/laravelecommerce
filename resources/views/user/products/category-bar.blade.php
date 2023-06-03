<style>
    .treeview {
        position: relative;
        display: block;
        margin-bottom: 10px;
        color: #6e768e;
font-family: "Cerebri Sans,sans-serif";
font-size: 0.95rem;
        margin-left: 18px;
    }

    .treeview i {
        position: absolute;
        top: 50%;
        right: 10px;
        color: #333;
        
    }
    ul{
        list-style-type: none;
 
    }
    .treeview.h31>i {
        transform: translateY(-50%) rotate(90deg);
    }
.h31{
        color: #00acc1;

    }
    .rotate-icon {
        transform: translateY(-50%) rotate(90deg);
    }
  
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="left-side-menu" style="margin-top: 75px;border-radius: 10px;">
    <div class="h-100" data-simplebar>
        @foreach($categories as $category)

        <li class="treeview {{ (request()->is('user/products/categories/*'. $category->id)) ? 'h31' : '' }}">
            <a class=" {{ (request()->is('user/products/categories/*'. $category->id)) ? 'h31' : '' }}" href="{{ route('user.categories.show', $category->id) }}"><span>{{ $category->title }}</span></a>
            <i class="fa fa-angle-right pull-right toggle-icon" data-toggle="collapse" data-target="#collapseExample{{$category->id}}" aria-expanded="false" aria-controls="collapseExample"></i>
            @if(count($category->subcategories))
            <ul class="collapse {{ (request()->is('user/products/categories/*'. $category->id)) ? 'show' : '' }}" id="collapseExample{{$category->id}}">
                @foreach($category->subcategories as $subcategory)
                <li class=" mt-2"><a class="{{ (request()->is('user/products/categories/sub_categories/'. $subcategory->id)) ? ' h31' : '' }}" href="{{route('user.sub-categories.show',$subcategory->id)}}"><i class="icon-Commit"></i>{{ $subcategory->title }}</a></li>
                @endforeach
            </ul>
            @endif
        </li>
        @endforeach
        <div class="clearfix"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.toggle-icon').click(function() {
            $(this).toggleClass('rotate-icon');
        });
    });
</script>
