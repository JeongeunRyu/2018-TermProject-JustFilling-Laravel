@extends('layouts.master')
@section('title')
	게시판
@endsection
@section('style')
	@include('components.style')
@endsection
@section('content')
	<div class="container my-5">
		<h1 class="display-4">자유게시판</h1>
		<p class="lead">마카롱에 관련된 내용을 자유롭게 공유해 주세요.</p>
	</div>
	<table class="table mx-auto w-75">
		<thead class="thead-light">
		<tr>
			<th>　</th>
			<th>제목</th>
			<th>작성자</th>
			<th>작성일</th>
			<th>조회수</th>
		</tr>
		</thead>
		@foreach($msgs as $msg)
			<tr>
				<td>{{$msg->id}}</td>
				<td>
					<a href="{{route('board.show', ['board'=>$msg->id, 'page'=>$page])}}" >
						{{$msg->title}}
					</a>
				</td>
				@if($state == "writer")
					<td>{{$msg->name}}</td>
				@else
				<td>{{$msg->user->name}}</td>
				@endif
				<td>{{$msg->created_at}}</td>
				<td>{{$msg->hits}}</td>
			</tr>
		@endforeach
	</table>
	<input type="button" value="글쓰기" onclick="location.href='{{route('board.create')}}'" class="btn btn-secondary btn-block w-75 my-2 mx-auto">



	<div class="form-row mb-4">
		<div class="col form-row" style="margin-left: 13%">
			<select class="custom-select col-sm-3" id="inputState" name="state">
				<option value="title">제목</option>
				<option value="content">글내용</option>
				<option value="titlencontent">제목+글내용</option>
				<option value="writer">작성자</option>
			</select>
			<input class="form-control col-3" type="search" name="search" id="inputText" placeholder="Search" aria-label="Search">
			<button class="btn btn-primary col-1" type="button" onclick="searchBtn({{$page}})">검색</button>
		</div>

		<ul class="col pagination justify-content-end" style="margin-right: 13%">
			{{$msgs->appends(['search'=>$search,'state'=>$state])->links()}}
		</ul>
	</div>








@endsection
@section('js')
	<script>
        $("body").css("display", "none");
        $("body").fadeIn(1000);

        function searchBtn(page) {
            var searchValue = document.getElementById('inputState').value;
            var search = document.getElementById('inputText').value;
            page = 1;
            var url = 'board?search=' + search + '&state=' + searchValue + '&page=' + page;

            location.href = url;
        }
	</script>
@endsection
