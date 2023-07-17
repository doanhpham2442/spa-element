<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Gender;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Users\UpdateUserRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserApiController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        try {
            $users = User::orderBy('id', 'asc')->get();
            return response()->json(['data' => $users], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new HttpResponseException(response()->json(['message' => 'User does not exis'], Response::HTTP_BAD_REQUEST));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function show(Request $request)
    {
        $requestData = $request->all();
        $user = User::find($requestData['id']);
        if (!$user) {
            return response()->json(['message' => 'Không tồn tại User'], Response::HTTP_BAD_REQUEST);
        }
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => bcrypt($request->input('password')),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return response()->json(['message' => 'Tạo mới thành công User'], Response::HTTP_OK);
    }

    public function update(UpdateUserRequest $request)
    {
        try {
            $requestData = $request->all();
            $user = User::findOrFail($requestData['id']);
            $user->{$requestData['nameCol']} = $requestData['value'];
            $user->save();
            return response()->json(['message' => 'Updated User Successfully '], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new HttpResponseException(response()->json(['message' => 'User does not exis'], Response::HTTP_BAD_REQUEST));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $requetsDatas = $request->all();

            $id = $requetsDatas['id'];
            $user = User::find($id);

            $user->delete();

        } catch (\Throwable $th) {
            Log::error($th);
        }


        // if (!$user) {
        //     return response()->json(['message' => 'Không tồn tại User'], Response::HTTP_BAD_REQUEST);
        // }
        // else{
        //     $deleted = User::destroy($id);
        //     if ($deleted) {
        //         return response()->json(['message' => 'Xóa thành công User'], Response::HTTP_OK);
        //     } else {
        //         return response()->json(['message' => 'Không tồn tại User'], Response::HTTP_BAD_REQUEST);
        //     }
        // }
    }
    public function getGender()
    {
        try {
            $gender = Gender::all();
            return response()->json(['data' => $gender], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new HttpResponseException(response()->json(['message' => 'Gender does not exis'], Response::HTTP_BAD_REQUEST));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    public function getEthnic()
    {
        try {
            $ethnic = DB::table('vn_ethnic')->get();
            return response()->json(['data' => $ethnic], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new HttpResponseException(response()->json(['message' => 'Ethnic does not exis'], Response::HTTP_BAD_REQUEST));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    public function getProvince()
    {
        try {
            $province = DB::table('vn_province')->get();
            return response()->json(['data' => $province], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new HttpResponseException(response()->json(['message' => 'Province does not exis'], Response::HTTP_BAD_REQUEST));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    public function getDistrict(Request $request)
    {
        try {
            $district = DB::table('vn_district')->get();
            return response()->json(['data' => $district], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new HttpResponseException(response()->json(['message' => 'District does not exis'], Response::HTTP_BAD_REQUEST));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
    public function getWard(Request $request)
    {
        try {
            $ward = DB::table('vn_ward')->get();
            return response()->json(['data' => $ward], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            throw new HttpResponseException(response()->json(['message' => 'Ward does not exis'], Response::HTTP_BAD_REQUEST));
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }


}