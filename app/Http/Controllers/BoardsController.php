<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Board;
use App\User;

class BoardsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('own')->only(['update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //


        $page = $request->page;
        $search = $request->search;
        $state = $request->state;
        $msgs = Board::orderBy('created_at', 'desc')->paginate(8);
        if($search) {
            switch ($state) {

                case "title":
                    $msgs = Board::where('title','like',"%$search%")->orderBy('created_at', 'desc')->paginate(8);
                    break;

                case "content":
                    $msgs = Board::where('content','like',"%$search%")->orderBy('created_at', 'desc')->paginate(8);
                    break;

                case "writer":
                    $msgs =  User::select(['users.name','boards.id','boards.title','boards.hits','boards.created_at'])
                            ->join('boards', 'boards.user_id', '=', 'users.id')
                            ->where('users.name', 'LIKE', "%$search%")->orderBy('id', 'desc')->paginate(8)->onEachSide(5);
                    break;

                case "titlencontent":
                    $msgs = Board::where('title','like',"%$search%")->orWhere('content','like',"%$search%")->orderBy('created_at', 'desc')->paginate(8);
                    break;
            }
        }
        return view('bbs.index')
            ->with('msgs', $msgs)
            ->with('page', $page)
            ->with('search',$search)
            ->with('state',$state);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bbs.write_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /*
        1. 사용자 입력한 게시글 정보를 boards 테이블에 insert
        (title, content, 로그인 사용자 id)
        */
        $user = Auth::user();
        /*
        DB::insert('insert into boards(title, content, user_id) values(?,?,?', [$resut->title, $request->content, $user->id]);
        */

        Board::create(['title'=>$request->title, 'content'=>$request->content, 'writer'=>$user->name, 'user_id'=>$user->id]);

        return redirect(route('board.index', ['page'=>1]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $page = $request->page;
        $board = Board::find($id);
        $board->hits++;
        $board->save();
        
        return view('bbs.show')->with('board', $board)->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
        $page = $request->page;
        $b = Board::find($id);
        return view('bbs.edit')->with('board', $b)->with('page', $page);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required', 
            'content'=>'required'
        ]);
        // 수정하고자 하는 글이 로그인한 사용자의 글인지 체크
        //그렇지 않으면 back()
        // 그렇다면 아래로 ...
        $b = Board::find($id);
        $b->title=$request->title;
        $b->content= $request->content;
        $b->save();

        return redirect(route('board.index', ['page'=>$request->page]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 삭제하고자 하는 글이 로그인한 사용자의 글인지 체크
        //그렇지 않으면 back()
        // 그렇다면 아래로 ...
        //
        // DB에서 $id에 해당하는 게시글을 읽어온다.
        // 읽어온 그 글에 대해 삭제 요청한다.
        $b = Board::find($id);
        $b->delete();

        return redirect(route('board.index'));
    }

    public function myArticles(Request $request) {
        //$msgs = Auth::user()->boards;

        $msgs = Board::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

        return view('board.index')->with('msgs', $msgs)->with('page', $request->page);
    }
}
