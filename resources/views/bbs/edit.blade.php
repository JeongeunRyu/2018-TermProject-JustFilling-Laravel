@extends('layouts.master')
@section('title')
	글수정
@endsection
@section('style')
	@include('components.style')
@endsection
@section('content')
	<form action="{{route('board.update', ['board'=>$board->id, 'page'=>$page])}}" method="post">
		@csrf
		@Method('PATCH')
		<div class="form-group">
			<label for="title">제목:</label>
			<input type="text" class="form-control" id="title" name="title"  value="{{$board->title}}">
			<span>
				@if($errors->has('title'))
					{{$errors->first('title')}}
				@endif
			</span>
		</div>
		<div class="form-group">
		<label for="content">내용</label>
			<textarea name="content" id="content" class="form-control" >{{$board->content}}</textarea>
			<span>
				@if($errors->has('content'))
					{{$errors->first('content')}}
				@endif
			</span>
		</div>
		<button class="btn btn-primary">수정하기</button>

	</form>
@endsection