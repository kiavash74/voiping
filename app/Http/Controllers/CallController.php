<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallController extends Controller
{
    /**
     * Display users in dropdown.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $users = DB::table('user')->get();
        return view('index', compact('users'));
    }

    /**
     * Display calls data in past 1 month.
     *
     * @param Request $request
     * @return Application|RedirectResponse
     */
    public function showCalls(Request $request)
    {
        $calls = DB::table('calls as ca')
            ->select('ct.id', 'ct.name', 'ca.call_date')
            ->join('contact as ct','ct.phone_number','=','ca.src_contact_number')
            ->join('user as u','u.phone_number','=','ca.dst_user_number')
            ->where('u.id', '=', $request->id)
            ->whereBetween('ca.call_date', array(date(Carbon::now()->subDays(30)), date(now())))
            ->get();
        $calls = $calls->toArray();
        return redirect('/index')->with('calls', $calls);
    }
}
