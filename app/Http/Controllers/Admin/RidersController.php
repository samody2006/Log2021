<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\RidersModel;
use App\Models\Rider;

use Lang;
use Auth;

class RidersController extends Controller
{
    
    public function index(Request $request)
    {
        $riderInfo = null;
        $ridersModel = new ridersModel();
        $riders = $ridersModel->getUsers();
        $edit = $request->input('edit');
        if ($edit != null) {
            $adminInfo = $ridersModel->getOneUser($edit);
            if ($adminInfo == null) {
                abort(404);
            }
        }
        return view('admin.riders', [
            'page_title_lang' => Lang::get('admin_pages.riders'),
            'riders' => $riders,
            'riderInfo' => $riderInfo
        ]);
    }

    public function setUser(Request $request)
    {
        $edit = $request->input('edit');
        $ridersModel = new ridersModel();
        if ($edit > 0) {
            $ridersModel->updateUser($request->all());
            $msg = Lang::get('admin_pages.user_is_updated');
        } else {
            $ridersModel->setUser($request->all());
            $msg = Lang::get('admin_pages.user_is_added');
        }
        return redirect(lang_url('admin/riders'))->with(['msg' => $msg, 'result' => true]);
    }

    public function deleteUser(Request $request)
    {
        if (isset($request->userId) && (int) $request->userId > 0) {
            $ridersModel = new ridersModel();
            $ridersModel->deleteUser($request->userId);
            return redirect(lang_url('admin/riders'))->with(['msg' => Lang::get('admin_pages.user_is_deleted'), 'result' => true]);
        } else {
            abort(404);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
