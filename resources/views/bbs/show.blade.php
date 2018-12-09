@extends('layouts.master')
@section('title')
	게시글 보기
@endsection
@section('style')
	@include('components.style')
@endsection
@section('content')
	<table class="table mx-auto w-75">
		<tr>
			<td>제목</td>
			<td>{{$board->title}}</td>
		</tr>
		<tr>
			<td>작성자</td>
			<td>{{$board->user->name}}</td>
		</tr>
		<tr>
			<td>조회수</td>
			<td>{{$board->hits}}</td>
		</tr>
		<tr>
			<td>생성일</td>
			<td>{{$board->created_at}}</td>
		</tr>
		<tr>
			<td>내용</td>
			<td>{!!$board->content!!}</td>
		</tr>
		<tr>
			<td>첨부파일</td>
			<td>
				<ul>
					@forelse($board->attachments as $attach)
						<li>
							<a href="{{'/files/' . Auth::user()->id . '/' . $attach->filename}}">
								{{$attach->filename}}
							</a>
						</li>
					@empty <li>첨부파일 없음</li>
					@endforelse
				</ul>
			</td>
		</tr>
	</table>

	<hr>

	<div class="row justify-content-center">
		<button class="btn btn-primary"
				onclick='location.href="{{route('board.index', ['page'=>$page])}}"'>목록보기</button>
		@if(Auth::user()->id == $board->user_id)
		<button class="btn btn-warning" onclick="location.href='{{route('board.edit', ['board'=>$board->id, 'page'=>$page])}}'">수정</button>
		<form action="{{route('board.destroy',['board'=>$board->id,'page'=>$page])}}" method="post">
			@method('delete')
			@csrf
			<button class="btn btn-danger" type="submit">삭제</button>
		</form>
		@endif
	</div>
@endsection
@section('js')
	<script>
        $("body").css("display", "none");
        $("body").fadeIn(1000);
	</script>
@endsection