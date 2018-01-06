@extends('master')

{{Session::get('message')}}

@section('content')
    <h1>My First Blog</h1>

    <!--we will loop to get all data from database here-->

    @foreach ($blogs as $blog)
        <h2><a href="/blog/{{$blog->id}}">{{$blog->title}}</a></h2>
        {{date('F d, Y', strtotime($blog->created_at))}}

        <!--<h2>{{$blog->title}}</h2>-->
        <p>{{$blog->description}}</p>
        <a href="/blog/{{$blog->id}}/edit">Edit this Post</a><br>
        <form class="" action="/blog/{{$blog->id}}" method="post">
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="submit" name="name" value="delete">
        </form>
        <hr>
    @endforeach

    {!! $blogs->links() !!}
@stop

    @section('sidebar2')
        <h4>Archives</h4>
        @foreach($blogs as $blog)
        <ol class="list-unstyled">
          <li><a href="/blog/{{$blog->id}}">{{$blog->description}}</a></li>
        </ol>
        @endforeach
    @stop
