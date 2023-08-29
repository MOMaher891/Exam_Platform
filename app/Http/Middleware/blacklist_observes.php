<?php

namespace App\Http\Middleware;

use App\Models\Black_lists;
use App\Models\Center;
use App\Models\Exam;
use App\Models\ExamTime;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class blacklist_observes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guard('observe')->check())
        {
            $centerId  = ExamTime::findOrFail($request->get('id'))->center_id;
            $isUserBlock = Black_lists::where('observe_id',auth('observe')->user()->id)->where('center_id',$centerId)->first();
            // return $centerId;
            if($isUserBlock)
            {
                return response()->json(['status'=>false,'message'=>'You Are Blocked From this Center']);
            }else{
                return $next($request);
            }
        }else{
            return $next($request);
        }
    }
}
