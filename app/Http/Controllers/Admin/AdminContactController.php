<?php
/**
 * Created by PhpStorm.
 * User: baonv
 * Date: 16/1/2018
 * Time: 5:56 PM
 */

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use Session;
use Helper;
use App\Models\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class AdminContactController extends Controller {


    function __construct() {
        $this->middleware('permission:contact-list', ['only' => ['index']]);
        $this->middleware('permission:contact-create', ['only' => ['create']]);
        $this->middleware('permission:contact-edit', ['only' => ['edit']]);
        $this->middleware('permission:contact-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $result = Contact::orderByDesc('created_at');
        $data['data'] = $result->paginate($this->limit);
        $data['i'] = ($request->input('page', 1) - 1) * $this->limit;
        return view('admin.contact.index', $data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $contact = Contact::find($id);
        if($contact) {
            $data['page_title'] = 'Chỉnh sửa contact - NCPC';
            $data['contact'] = $contact;
            return view('admin.contact.edit', $data);
        }

        return redirect()->route('admin.contacts.index')
            ->with('error','Contact not exist!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::find($id)->delete();
        return redirect()->route('admin.contacts.index')
            ->with('success','Contact deleted successfully');
    }

}