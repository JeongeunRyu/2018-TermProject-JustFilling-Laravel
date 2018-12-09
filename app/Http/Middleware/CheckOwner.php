<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Board;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*
        로그인 한 사용자와, 요청 정보에 있는
        id(게시글의 id)를 이용해 게시글을 DB에서 
        가져오고, 그 가져온 게시글의 user_id와 비교
        다르면 back();
        같으면 밑으로 
        */
        \Log::debug('middelware(auth)', ['step1'=>'here1']);
        $user = Auth::user();
        \Log::debug('middelware(auth)', ['step2'=>'here2']);
        $id = $request->route('board');
        \Log::debug('middelware(auth)', ['step3'=>'here3']);
        $b = Board::find($id);
        \Log::debug('middelware(auth)', ['step4'=>'here4']);
        if(!$b || $user->id != $b->user_id) {
            flash('니는 권한이 없어!!!!')->error();
            return back();
        }
        \Log::debug('middelware(auth)', ['step51'=>'here5']);
        return $next($request);
    }
}
