<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LibraryManagerController extends Controller
{
    // user_id
    public function createLibraryManager(Request $request){
		$user = \App\User::find($request->user_id);
		if($user){
			$item = \App\Model\LibraryManager::where('user_id', $request->user_id)
											  ->first();
			if($item){
				return response()->json(['created' => false], 200);
			} else {
				$manager = new \App\Model\LibraryManager();
				$manager->user_id = $request->user_id;
				$manager->created_at = date('Y-m-d H:i:s');
				$manager->updated_at = date('Y-m-d H:i:s');
				$manager->save();
				$subarray = array();
				array_push($subarray, $manager, $user);
				return response()->json(['created' => true, 'manager' => $subarray], 200);
			}
		} else {
			return response()->json(['created' => false], 200);
		}
    }

    // email
    public function getUser(Request $request){
        $user = \App\User::where('email', $request->email)
                        ->first();
        if($user){
            return response()->json(['search' => true, 'user' => $user], 200);
        } else {
            return response()->json(['search' => false], 200);
        }
    }

    public function deleteLibraryManager(Request $request) {
		$item = \App\Model\LibraryManager::find($request->id);
		$res = $item->delete();
		if($res){
			return response()->json(['deleted' => true], 200);
		} else {
			return response()->json(['deleted' => false], 200);
		}
    }

    public function getAllLibraryManager(){
		$items = \App\Model\LibraryManager::all();
		$array = array();
		foreach($items as $item){
			$user = \App\User::find($item->user_id);
			$subarray = array();
			array_push($subarray, $item, $user);
			array_push($array, $subarray);
		}
		return response()->json(['get' => true, 'libraryManager'=>$array], 200);
	}
	
	public function getUserByUserCode(Request $request) {
		$user = \App\User::where('usercode', $request->usercode)
						 ->first();
		if($user){
			return response()->json(['get' => true, 'user'=>$user], 200);
		} else {
			return response()->json(['get' => false], 200);
		}
	}
}
