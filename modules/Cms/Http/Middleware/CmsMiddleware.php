<?php
/**
 * Created by PhpStorm.
 * User: DELL M4800
 * Date: 9/19/2018
 * Time: 10:50 PM
 */

namespace Modules\Cms\Http\Middleware;

use App\Common\Untils\Permission;
use App\Common\Untils\Regular;
use Illuminate\Http\Request;

use Closure;

class CmsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard(Regular::PREFIX_CMS)->check()) {
            return redirect('cms/login');
        }
        if(auth()->guard(Regular::PREFIX_CMS)->user()->role_id != Permission::PERM_ADMIN && auth()->guard(Regular::PREFIX_CMS)->user()->role_id != Permission::PERM_EDITOR){
            auth()->guard(Regular::PREFIX_CMS)->logout();
            session()->flush();
            return redirect('cms/login')->with(['error' => 'You haven\'t permission admin!']);
        }

        return $next($request);
    }
}
