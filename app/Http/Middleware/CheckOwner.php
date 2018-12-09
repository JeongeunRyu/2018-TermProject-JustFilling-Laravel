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
        \Log::debug('middelware(auth)', ['step1'=>'here1']);
        $user = Auth::user();
        \Log::debug('middelware(auth)', ['step2'=>'here2']);
        $id = $request->route('board');
        \Log::debug('middelware(auth)', ['step3'=>'here3']);
        $b = Board::find($id);
        \Log::debug('middelware(auth)', ['step4'=>'here4']);
        if(!$b || $user->id != $b->user_id) {
            flash('권한이 없습니다.')->error();
            return back();
        }
        \Log::debug('middelware(auth)', ['step51'=>'here5']);
        return $next($request);
    }
}
