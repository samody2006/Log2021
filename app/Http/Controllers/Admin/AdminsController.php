<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\AdminsModel;
use App\Models\Admin;
use Lang;
use Auth;

class AdminsController extends Controller
{
    
    public function index(Request $request)
    {
        $adminInfo = null;
        $adminsModel = new adminsModel();
        $admins = $adminsModel->getUsers();
        $edit = $request->input('edit');
        if ($edit != null) {
            $adminInfo = $adminsModel->getOneUser($edit);
            if ($adminInfo == null) {
                abort(404);
            }
        }
        return view('admin.admins', [
            'page_title_lang' => Lang::get('admin_pages.admins'),
            'admins' => $admins,
            'adminInfo' => $adminInfo
        ]);
    }

    public function setUser(Request $request)
    {
        $edit = $request->input('edit');
        $adminsModel = new adminsModel();
        if ($edit > 0) {
            $adminsModel->updateUser($request->all());
            $msg = Lang::get('admin_pages.user_is_updated');
        } else {
            $adminsModel->setUser($request->all());
            $msg = Lang::get('admin_pages.user_is_added');
        }
        return redirect(lang_url('admin/admins'))->with(['msg' => $msg, 'result' => true]);
    }

    public function deleteUser(Request $request)
    {
        if (isset($request->userId) && (int) $request->userId > 0) {
            $adminsModel = new adminsModel();
            $adminsModel->deleteUser($request->userId);
            return redirect(lang_url('admin/admins'))->with(['msg' => Lang::get('admin_pages.user_is_deleted'), 'result' => true]);
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
