<?php

namespace App\Http\Controllers\API;

use App\Models\Film;
use Illuminate\Http\Request;
use App\Http\Controllers\API\MainController;

use Validator;


class FilmController extends MainController
{
    public function index()
    {
        $datas = Film::all();
    
        return $this->sendResponse($datas, 'Film berhasil ditemukan.', 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string',
        ]);

        if($validator->fails()){
            return $this->sendResponse(
                $validator->errors(), 
                'Terjadi Kesalahan!, Silahkan coba lagi!', 
                402 
            );       
        }

        try {
            $film = Film::create([
                'title' => $request->title,
                'description'=> $request->description,
                'image_thumbnail' => $request->image,
            ]);

            $response = $this->sendResponse($film, 'Berhasil menambahkan film', 200);

        } catch (\Throwable $th) {
            $response = $this->sendResponse($th, 'Terjadi Kesalahan Hubungi Administrator', 500);
        }

        return $response;
    }

    public function show($id)
    {
        $data = Film::find($id);
  
        $response = $this->sendResponse($data, 'Data berhasil ditemukan.', 200);

        if (is_null($data)) {
            $response = $this->sendResponse($data,'data not found.', 404);
        }
      
        return $response;
    }


    public function update(Request $request, Film $film)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|string',
        ]);
   
        if($validator->fails()){
            $response =  $this->sendResponse(
                $validator->errors(),
                'Mohon input yang tidak boleh kosong.', 
                402);       
        }
   
        try {
            $film->title = $request->title;
            $film->description = $request->description;
            $film->image_thumbnail = $request->image;
            $film->save();
            
            $response = $this->sendResponse($film, 'Data berhasil di update.', 200);
            
        } catch (\Throwable $th) {
            $response = $this->sendResponse($th, 'Terjadi Kesalahan Hubungi Administrator', 500);
        }


        return $response;
    }

    public function destroy(Film $film)
    {
        try {
            $film->delete();

            $response = $this->sendResponse(null, 'Film berhasil dihapus.', 200);

        }  catch (\Throwable $th) {
            $response = $this->sendResponse($th, 'Terjadi Kesalahan Hubungi Administrator', 500);
        }
   
        return $response;
    }



}
