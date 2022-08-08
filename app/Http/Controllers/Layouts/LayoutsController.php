<?php
namespace App\Http\Controllers\Layouts;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class LayoutsController extends Controller {
  public function sidebar(Request $request) {
    if($request->ajax()) {
      $sidebar = User::find(Auth::user()->id);
      if($sidebar->sidebar != null) {
        $sidebar->sidebar = null;
      } else {
        $sidebar->sidebar = 'sidebar-collapse';
      }
      $sidebar->save();
      return $sidebar;
    } else {
      return redirect('home');
    }
  }
}