@extends('layouts.app')

@section('header')
     <!-- Start Header -->
     <header id="teraHeader">
        <!-- Content  -->
        <div class="text-light">
            <h2 class="tera-text-8">Tera Blog</h2>
            <p class="text-capitalize tera-text-2">The Real Blog by laravel</p>
        </div>
        <!-- Arrow -->
        <div class="arrow bounce">
        <img src="{{asset('storage/static/arrow-down.svg')}}" alt="arrow down" width="60" height="60">
        </div>
    </header>
    <!-- Start Header -->
@endsection

@section('teracontent')
<div class="teraPosts">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @if ($PostsData->count() > 0)
                    @foreach ($PostsData as $key=>$Post)
                        <!-- Single Post -->
                        <div class="col-sm-6 mb-4" data-aos="fade-down-right" data-wow-duration="2s"
                        data-wow-delay=".5s" data-aos-delay="{{($key+1)*850}}">
                            <div class="card border teraPost mb-6">
                                <a href="{{route('viewPost',$Post->id)}}">
                                    <img src="{{asset('storage/'.$Post->image)}}" class="card-img-top" alt="post image">
                                    <div class="txt-cate text-center">
                                        <p>{{$Post->category->name}}</p>
                                        <h3 class="mb-5">{{$Post->title}}</h3>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-danger">
                        Sorry, No Posts Available Right Now
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-3">
            <!-- slide menu  -->
            <div id="teraSide" class="fixedSide">
                <div class="slideMenu">
                    <!-- search bar -->
                    <div class="searchbar" data-aos="zoom-in" data-aos-delay="500" data-aos-once="true">
                        <h5>Search</h5>
                        <form action="/" method="get">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="search" value="{{$Request->search}}" placeholder="Enter Word" aria-describedby="button-addon1">
                                <div class="input-group-prepend">
                                    <button class="btn btn-secondary" type="submit" id="button-addon1">Go</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="my-5"></div>

                    <!-- categories select  -->
                    <div class="categories" data-aos="zoom-out-left" data-aos-delay="1000"
                        data-aos-once="true">
                        <h5>Categories</h5>
                        @if ($Categories->count() > 0)
                            <div class="catebtns">
                                @foreach ($Categories as $key=>$Cate)
                                @if ($Cate->id == $Request->cate)
                                    <form action="/" method="get">
                                        <input type="submit" class="ma-3 btn btn-dark btn-sm" value="{{$Cate->name}}">
                                    </form>
                                @else
                                    <form action="/" method="get">
                                        <input name="cate" type="hidden" value="{{$Cate->id}}">
                                        <input type="submit" class="ma-3 btn btn-outline-dark btn-sm" value="{{$Cate->name}}">
                                    </form>
                                @endif                                    
                                   
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-danger">
                                Sorry, No Categories
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{$PostsData->links()}}

</div>
@endsection



@section('scripts')
<script>
    const myHeader = document.getElementById('teraHeader');    
    myHeader.style.height = `${window.innerHeight}px`; // set header to full screen
</script>
@endsection