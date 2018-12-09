@extends('layouts.master')
@section('title')
	글수정
@endsection
@section('style')
	<link href="/dist/dropzone.css" rel="stylesheet">
	<script src="/dist/dropzone.js"></script>
	<script src="/ckeditor/ckeditor.js"></script>
	@include('components.style')

@endsection
@section('content')
	<div class="container my-5">
		<h1 class="display-4">글 수정</h1>
	</div>

	<form action="{{route('board.update', ['board'=>$board->id, 'page'=>$page])}}" method="post">
		@csrf
		@Method('PATCH')
        <div class="w-75 mx-auto">
		<div class="form-group">
			<label for="title">제목</label>
			<input type="text" class="form-control" id="title" name="title"  value="{{$board->title}}">
			<span>
				@if($errors->has('title'))
					{{$errors->first('title')}}
				@endif
			</span>
		</div>
		<div class="form-group">
		<label>내용</label>
			<textarea name="content"  id="editor1" class="form-control">

				{{$board->content}}</textarea>
			<span>
				@if($errors->has('content'))
					{{$errors->first('content')}}
				@endif
			</span>
		</div>
	</div>
    <div class="mb-4 row justify-content-center">
        <button class="btn btn-primary ">수정하기</button>
    </div>


	</form>
@endsection

@section('js')
	<script>
        $("body").css("display", "none");
        $("body").fadeIn(1000);

        Dropzone.options.dropzone = {
            addRemoveLinks: true,

            success: function(file, response) {
                alert(response.filename);
                file.upload.id = response.id;
                $("<input>", {type:'hidden', name:'attachments[]', value:response.id}).appendTo($('#store'));
            },
            error: function(file, response){
                alert('error');
                return false;
            }
        }


        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace( 'editor1', {

            'filebrowserUploadUrl': "{{URL::to('/')}}/ckeditor/upload.php"

        });

        CKEDITOR.on('dialogDefinition', function (ev) {

            var dialogName = ev.data.name;

            var dialog = ev.data.definition.dialog;

            var dialogDefinition = ev.data.definition;

            if (dialogName == 'image') {

                dialog.on('show', function (obj) {

                    this.selectPage('Upload'); //업로드텝으로 시작

                });

                dialogDefinition.removeContents('advanced'); // 자세히탭 제거
                dialogDefinition.removeContents('Link'); // 링크탭 제거

            }

        });


	</script>
@endsection