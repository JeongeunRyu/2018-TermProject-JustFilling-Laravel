@extends('layouts.master')
@section('title')
    글작성
@endsection
@section('style')
    <link href="/dist/dropzone.css" rel="stylesheet">
    <script src="/dist/dropzone.js"></script>
    <script src="/ckeditor/ckeditor.js"></script>
    @include('components.style')
@endsection
@section('content')
    <div class="container">
        <div class="container my-5">
            <h1 class="display-4">새 글 쓰기</h1>
        </div>
        <form id="store" action="{{route('board.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}"
                       required>
                <div>
                    @if($errors->has('title'))
                        <span class="warning">
             {{$errors->first('title')}}
            </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="content">내용</label>
                <textarea name="content" id="editor1"  cols="80" class="form-control" required>{{old('content')}}</textarea>

                <div>
                    @if($errors->has('content'))
             {!! $errors->first !!}
            </span>
                    @endif
                </div>
            </div>
        </form>

        <form action="{{route('attachments.store')}}"
              class="dropzone"
              id="dropzone">
            @csrf
        </form>

    </div>


    <div class="m-1 mb-5 row justify-content-center">
        <button type="button" class="btn btn-primary mx-1" onclick="$('#store').submit()">
            글등록
        </button>
        <a class="btn btn-danger" href="{{route('board.index',['page'=>1])}}">목록보기</a>
    </div>
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