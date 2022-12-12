<?php

namespace App\Http\Controllers;

use App\Models\ListModel;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;

class ListModelController extends Controller
{
    //
    public function index()
    {
        $list = ListModel::all();
        $title = 'To Do List';
        return view('index', compact('title', 'list'));
    }
    public function showAll()
    {
        $list = ListModel::all();
        if ($list == null) {
            $response = ['status' => false, 'massage' => 'list tidak ditemukan', 'data' => null];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'massage' => 'list ditemukan', 'data' => $list];
        return Response()->json($response, 200);
    }
    public function done(Request $request)
    {
        // dd($request->idList);
        if (!ListModel::doneLIst($request->idList)) {
            $response = ['status' => false, 'massage' => 'gagal melakukan update list'];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'massage' => 'berhasil melakukan update'];
        return Response()->json($response, 200);
    }
    public function store(Request $request)
    {
        $request->validate(['listName' => 'required']);
        $newList = ['list_name' => $request->listName];
        if (!ListModel::storeLIst($newList)) {
            $response = ['status' => false, 'massage' => 'gagal melakukan simpan list baru'];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'massage' => 'berhasil melakukan simpan list baru'];
        return Response()->json($response, 200);
    }
    public function delete(Request $request)
    {
        if (!ListModel::deleteLIst($request->idList)) {
            $response = ['status' => false, 'massage' => 'gagal melakukan delete list'];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'massage' => 'berhasil melakukan delete'];
        return Response()->json($response, 200);
    }
    public function update(Request $request)
    {
        if (!ListModel::updateList($request->idList, $request->listBaru)) {
            $response = ['status' => false, 'massage' => 'gagal melakukan update list'];
            return Response()->json($response, 401);
        }
        $response = ['status' => true, 'massage' => 'berhasil melakukan update'];
        return Response()->json($response, 200);
    }
}
