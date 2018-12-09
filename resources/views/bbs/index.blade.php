@extends('layouts.master')
@section('title')
	게시판
@endsection
@section('style')
	@include('components.style')
@endsection
@section('content')
	<table class="table table-striped">
		<tr>
			<th>　</th>
			<th>제목</th>
			<th>작성자</th>
			<th>작성일</th>
			<th>조회수</th>
		</tr>
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


]
		<select class="custom-select" id="inputState" name="state">
			<option value="title">제목</option>
			<option value="content">글내용</option>
			<option value="titlencontent">제목+글내용</option>
			<option value="writer">작성자</option>
		</select>
		<input class="form-control mr-sm-2" type="search" name="search" id="inputText" placeholder="Search" aria-label="Search">
		<button class="btn btn-outline-success my-2 my-sm-0" type="button" onclick="searchBtn({{$page}})">검색</button>


	<input type="button" value="글쓰기" onclick="location.href='{{route('board.create')}}'" class="btn btn-danger">
	{{$msgs->appends(['search'=>$search,'state'=>$state])->links()}}
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
