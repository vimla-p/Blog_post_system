<div class="col-lg-2 col-md-12 col-sm-12 col-xs-12">
    <div class="widget">
        <h2 class="widget-title">All Categories</h2>
        <div class="link-widget">
            <ul>
            @php
               $i=0; 
            @endphp
                @foreach ($data as $item)
                    <li>{{ $item->name }} <span>
                      
                      ({{$item->blogs->count()}} )</span></li>
                     
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->
</div>
