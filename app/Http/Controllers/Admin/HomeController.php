<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Visitor;
use App\Page;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request) 
    {
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount   = 0;
        $userCount   = 0;
        $interval    = intval( $request->input('interval', 30) );

        // Contagem de Visitantes
        $dateInterval = date('Y-m-d H:i:s', strtotime('-'.$interval.' days'));
        $visitsCount = Visitor::where('date_access', '>=', $dateInterval)->count();

        // Contagem de Usúario Online
        $datelimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_access', '>=', $datelimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        // Contagem de Páginas
        $pageCount = Page::count();

        // Contagem de Usúario
        $userCount = User::count();

        // Contagem para o PagePie
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as c')->where('date_access', '>=', $dateInterval)->groupBy('page')->get();
        foreach($visitsAll as $visit) {
            $pagePie[ $visit['page'] ] = intval( $visit['c'] );
        }

        $pageLabels = json_encode( array_keys($pagePie) );
        $pageValues = json_encode( array_values($pagePie) );

        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount'   => $pageCount,
            'userCount'   => $userCount,
            'pageLabels'  => $pageLabels,
            'pageValues'  => $pageValues,
            'dateInterval'=> $interval
        ]);
    }
    
}
