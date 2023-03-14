<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\UserDocument;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documentList = UserDocument::with('document')->where('user_id','=',auth()->user()->id)->get();
        //return $documentList;
        return view('document.UserDocumentIndex',compact('documentList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $documentList = Document::all();
        //dd($documentList);
        return view('document.uploadDocument',compact('documentList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'document_id'       =>    'required|numeric|exists:documents,id|unique:user_documents,document_id',
            'document.*'        =>    'required|mimes:png,jpg,jpeg',
        ],[
            'document_id.unique'    =>  'Document Already Uploaded.',
        ]);

        $paths = array();
        $userName = auth()->user()->name;
        foreach ($request->file("document") as $imagefile) {
            $extension  = $imagefile->getClientOriginalExtension();
            $filename   = rand(1000,9999).'.'.$extension;
            $path = '/storage/document/' . $userName . '/';
            $imagefile->move(public_path() .$path,$filename);
            array_push($paths,$path.$filename);
        }

       //return $paths;
       
       $userDocument = UserDocument::create([
            'document_id'   => $request->document_id,
            'path'          => $paths,
            'user_id'       => auth()->user()->id,
            'expired_date'  => Carbon::now()->addMonths(2),
       ]);

       return redirect()->route('success.msg')->with('success','Document Uploaded Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function show(UserDocument $userDocument)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userDocument = UserDocument::findOrFail($id);
        $documentList = Document::all();
        //return $userDocument;
        return view('document.updateDocument',compact(['userDocument','documentList']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request->all();
        $request->validate([
            'document_id'       =>    'required|numeric|exists:documents,id',
            'document.*'        =>    'required|mimes:png,jpg,jpeg',
        ],[
            'document_id.unique'    =>  'Document Already Uploaded.',
        ]);

        $userDocument = UserDocument::findOrFail($id);
        
        foreach ($userDocument->path as $imagePath) {
            unlink(public_path() .$imagePath);
        }

        $paths = array();
        $userName = auth()->user()->name;
        foreach ($request->file("document") as $imagefile) {
            $extension  = $imagefile->getClientOriginalExtension();
            $filename   = rand(1000,9999).'.'.$extension;
            $path = '/storage/document/' . $userName . '/';
            $imagefile->move(public_path() .$path,$filename);
            array_push($paths,$path.$filename);
        }
        
        $userDocument->update([
            'document_id'   =>  $request->document_id,
            'path'          =>  $paths,
        ]);

        return redirect()->route('success.msg')->with('success','Document Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDocument  $userDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userDocument =  UserDocument::findOrFail($id);

        foreach ($userDocument->path as $imagePath) {
            unlink(public_path() .$imagePath);
        }

        $userDocument->delete();

        return redirect()->route('success.msg')->with('success','Document deleted successfully');
    }
}
