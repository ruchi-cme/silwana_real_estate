<x-base>
    <x-banner title="Our Projects" page="{{$title}}"></x-banner>

<style>
    .loader {
        width: 120px ;
        height: 100px ;
    }
    .ajax-load{
        background: #e1e1e1;
        padding: 10px 0px;
        width: 100%;
    }
</style>
<!-- property-detail-main -->
<section class="property-detail-main mt-0">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="search-property">
                    <h2>Search Property</h2>
                    <form action="{{ route('ourProject/projectSearch' ) }}" method="post">
                        @csrf
                        <div class="form-group mb-0 position-relative">
                            <input type="text" name="searchProject" class="form-control" placeholder="eg. silwana real estate">
                            <input type="hidden" name="currentURL"  value="{{$currentURL}}">
                            @if( !empty(request()->id))
                                <input type="hidden" name="category_id"  value="{{ decrypt(request()->id) }}">
                            @endif
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="cmn-btn search-btn"><img src="{{asset("images/front" )}}/search.svg" alt="search" /> search</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row" id="post-data">
                @include('front.projectList')
            </div>

            <div class="ajax-load text-center" style="display:none">

                <p><img src="{{ asset('images/front/loading.gif') }}" class="loader" /> Loading More post</p>

            </div>
        </div>


    </div>

</section>
    @section('scripts')
          <script type="text/javascript">
            var page = 1;

            $(window).scroll(function() {

               if($(window).scrollTop() + $(window).height() >= 1770) {
                    page++;
                    loadMoreData(page);
                 }
            });

            function loadMoreData(page){

                $.ajax(
                    {
                        url: '?page=' + page,
                        type: "get",
                        beforeSend: function()
                        {
                            $('.ajax-load').show();
                        }
                    })

                    .done(function(data)
                    {
                        if(data.html == ""){

                            $('.ajax-load').html("No more records found");
                            return;
                        }

                        $('.ajax-load').hide();
                        $("#post-data").append(data.html);

                    })

                    .fail(function(jqXHR, ajaxOptions, thrownError)

                    {

                        alert('server not responding...');

                    });

            }
        </script>
    @endsection
</x-base>
