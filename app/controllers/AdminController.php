<?php
/**
 * Created by PhpStorm.
 * User: yckao85
 * Date: 15/2/18
 * Time: 下午6:07
 */
class AdminController extends BaseController {
    public function login()
    {
        $account=Input::get('inputAccount');
        $password=Input::get('inputPassword');
        if (Auth::attempt(array('account' => $account, 'password' => $password)))
        {
            return Redirect::intended('/admin');
        }
        else
        {
            return View::make('admin.login');
        }
    }

    public function logout()
    {
        Auth::logout();
        return Redirect::to('/admin')->with('logout', '#');
    }
}

