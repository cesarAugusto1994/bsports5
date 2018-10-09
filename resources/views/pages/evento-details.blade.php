@extends('layouts.layout')

@section('css')
    <style>

      .event-txt-wrap .event-txt {
        width: 100%;
      }

      .team-box {
          background-color: #f4f4f4;
      }

    </style>
@stop

@section('content')


<div class="page-wrapper">

    <!-- Blog Full Start -->
    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <!--Blog Post Start-->
                    <div class="blog-post">
                        <h3><a href="#">{{ $evento->titulo }}</a></h3>
                        <div class="blog-thumb"><img src="./images/blog-full-1.jpg" alt="" /> </div>
                        <div class="blog-content">
                          <!--
                            <ul class="post-tags">
                                <li><strong>Tags:</strong></li>
                                <li> <a href="#">Champion League</a> <a href="#">Football</a> <a href="#">Basketball</a> <a href="#">Rugby Sports</a> </li>
                            </ul>
                            <ul class="post-meta">
                                <li><i class="fa fa-calendar"></i> 07 Feb 2018</li>
                                <li><i class="fa fa-thumbs-up"></i> 178 Likes</li>
                                <li><i class="fa fa-comment"></i> 56 Comments</li>
                                <li><i class="fa fa-folder"></i> Football</li>
                            </ul>
                          -->
                            {!! $evento->conteudo !!}
                        </div>
                    </div>
                    <!--Blog Post End-->

                </div>

            </div>
        </div>
    </div>
    <!-- Blog Full End -->

</div>

@endsection
