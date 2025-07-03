<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TDestino;
use App\THotel;
use App\THotelDestino;
use App\THotelImagen;
use App\TPaquete;
use App\TPaqueteDestino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function index()
    {
        $hotel = THotel::paginate(10);
        return view('admin.hotel', compact('hotel'));
    }
    public function create()
    {
        $destinations = TDestino::all()->sortBy('nombre');
        $host = $_SERVER["HTTP_HOST"];
        return view('admin.hotel-create', compact('host','destinations'));
    }
    public function store(Request $request)
    {
        $hotel = $request->input('txt_hotel');


        $hotel = new THotel();
        $hotel->nombre = $request->input('txt_hotel');
        $hotel->short = $request->input('txta_short');
        $hotel->descripcion = $request->input('txta_descripcion');
        $hotel->estrellas = $request->input('slc_category');
        $hotel->direccion = $request->input('txt_address');
        $hotel->url = $request->input('url');
        $hotel->expedia = $request->input('txt_Expedia');
        $hotel->tripadvisor = $request->input('txt_Tripadvisor');
        $hotel->imagen=$request->input('id_blog_file');
        $servicios = "";
        foreach ($request->input('slc_services') as $services){
            $servicios .=  $services.',';
        }
        $hotel->servicios = substr($servicios, 0, -1);

        if ($hotel->save()){
            $hotel_destinations = THotelDestino::where('idhotel', $hotel->id)->get();
            $var_d = [];
            if ($request->input('destino')) {
                foreach ($hotel_destinations as $hotel_d){
                    if (!in_array($hotel_d->iddestinos, $request->input('destino'))){
                        $temp = THotelDestino::find($hotel_d->id);
                        $temp->delete();
                    }
                    $var_d[] = $hotel_d->iddestinos;
                }
                for($i=0; $i < count($request->input('destino')); $i++){
                    if (!in_array($request->input('destino')[$i], $var_d)){
                        $hotel_destinations = new THotelDestino();
                        $hotel_destinations->idhotel = $hotel->id;
                        $hotel_destinations->iddestinos = $request->input('destino')[$i];
                        $hotel_destinations->save();
                    }
                }
            }else{
                THotelDestino::where('idhotel', $hotel->id)->delete();
            }
        }

        $gallery = $request->input('hotel_slider_images');
        if ($gallery) {
            $imagenes = is_array($gallery) ? $gallery : explode(',', $gallery);
            foreach ($imagenes as $img) {
                THotelImagen::create([
                    'idhotel' => $hotel->id,
                    'imagen' => trim($img),
                ]);
            }
        }



        return redirect(route('admin_hotel_index_path'))->with('status', 'Hotel created successfully');

    }
    public function hotel_slider_deleteFile(Request $request)
    {
        $name = $request->get('name_file');
        Storage::disk('s3')->delete('hotel/slider/'.$name);
        return $name;
    }


    public function edit($id)
    {
        $hotel = THotel::where('id', $id)->get();
        $destinations = TDestino::all();
        $hotel_destino = THotelDestino::where('idhotel', $id)->get();
        $host = $_SERVER["HTTP_HOST"];
        return view('admin.hotel-edit', compact('hotel','host','destinations','hotel_destino'));
    }

    public function update(Request $request, $id)
    {
        $hotel = THotel::FindOrFail($id);
        $hotel->nombre = $request->input('txt_hotel');
        $hotel->short = $request->input('txta_short');
        $hotel->descripcion = $request->input('txta_descripcion');
        $hotel->estrellas = $request->input('slc_category');
        $hotel->direccion = $request->input('txt_address');
        $hotel->url = $request->input('url');
        $hotel->expedia = $request->input('txt_Expedia');
        $hotel->tripadvisor = $request->input('txt_Tripadvisor');
        if ($request->input('slc_services')){
            $servicios = "";
            foreach ($request->input('slc_services') as $services){
                $servicios .=  $services.',';
            }
            $hotel->servicios = substr($servicios, 0, -1);
        }else{
            $hotel->servicios = NULL;
        }

        if ($hotel->save()){
            if ($request->input('destino')){
                THotelDestino::where('idhotel', $id)->delete();
                for($i=0; $i < count($request->input('destino')); $i++){

                    $hotel_destinations = new THotelDestino();
                    $hotel_destinations->idhotel = $id;
                    $hotel_destinations->iddestinos = $request->input('destino')[$i];
                    $hotel_destinations->save();

                }
            }else{
                THotelDestino::where('idhotel', $id)->delete();
            }
        }

        return redirect(route('admin_hotel_edit_path', $id))->with('status', 'Successfully updated package');

    }

    public function uploadGallery(Request $request)
    {
        $request->validate([
            'file' => 'required|image',
            'idhotel' => 'required|integer|exists:thotel,id'
        ]);

        $filename = $request->file('file')->getClientOriginalName();
        $nameToStore = pathinfo($filename, PATHINFO_FILENAME).'_'.time().'.'.$request->file('file')->getClientOriginalExtension();

        Storage::disk('s3')->put('hotel/'.$nameToStore, fopen($request->file('file'), 'r+'), 'public');
        $url = Storage::disk('s3')->url('hotel/'.$nameToStore);

        THotelImagen::create([
            'idhotel' => $request->idhotel,
            'imagen' => $url,
        ]);

        return response()->json(['success' => true, 'url' => $url]);
    }

//    public function deleteGalleryImage(Request $request)
//    {
//        $request->validate([
//            'imagen_id' => 'required|exists:thotelimagen,id'
//        ]);
//
//        $imagen = THotelImagen::find($request->imagen_id);
//        $imagen->delete();
//
//        return back()->with('status', 'Imagen eliminada correctamente');
//    }


    public function destroy($id)
    {
        $hotel=THotel::find($id);
        $hotel_destino=THotelDestino::where('idhotel',$id)->first();
        if($hotel_destino){
            return redirect(route('admin_hotel_index_path'))->with('status', 'It cannot be deleted');
        }else{

            if ($hotel->imagen != NULL) {
                $filename = explode('hotel/', $hotel->imagen);
                $filename = $filename[1];
                Storage::disk('s3')->delete('hotel/' . $filename);
            }
            $hotel->delete();
            return redirect(route('admin_hotel_index_path'))->with('status', 'Hotel successfully removed');
        }

    }
    public function image_store(Request $request)
    {
        $id_hotel = $request->get('id_hotel_file');

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('hotel/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('hotel/'.$filenametostore);

        $imageUpload = THotel::FindOrFail($id_hotel);
        $imageUpload->imagen = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function image_delete_form(Request $request)
    {
        $id_hotel_file = $request->input('id_hotel');
        $hotel = THotel::find($id_hotel_file);

        $filename = explode('hotel/', $hotel->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('hotel/'.$filename);

        THotel::where('id', $id_hotel_file)->update(['imagen' => NULL]);
//        return $filename;

        return redirect(route('admin_hotel_edit_path', $id_hotel_file))->with('delete', 'Image successfully removed');
    }



    public function deleteGalleryImage(Request $request)
    {
        $id_imagen = $request->get('imagen_id');
        if (!$id_imagen) {
            return back()->with('error', 'ID de imagen no recibido.');
        }

        $imagen = THotelImagen::find($id_imagen);
        if (!$imagen) {
            return back()->with('error', 'Imagen no encontrada.');
        }

        $filenameParts = explode('hotel/', $imagen->imagen);
        if (isset($filenameParts[1])) {
            $filename = $filenameParts[1];
            Storage::disk('s3')->delete('hotel/' . $filename);
        }

        $imagen->delete();

        return back()->with('status', 'Imagen eliminada correctamente');
    }


    public function image_delete_hotel(Request $request)
    {
        $id_hotel_file = $request->input('id_hotel_file');
        $hotel = THotel::find($id_hotel_file);

        $filename = explode('hotel/', $hotel->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('hotel/'.$filename);

        THotel::where('id', $id_hotel_file)->update(['imagen' => NULL]);
        return $filename;
    }
    public function hotel_imagen_getFile(Request $request){
        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('hotel/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('hotel/'.$filenametostore);
        return $imageName;
    }
    public function hotel_imagen_gallery_store(Request $request)
    {
        $request->validate([
            'file' => 'required|image',
            'idhotel' => 'required|integer|exists:thotel,id',
        ]);

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('hotel/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $url = Storage::disk('s3')->url('hotel/'.$filenametostore);

        THotelImagen::create([
            'idhotel' => $request->idhotel,
            'imagen' => $url,
        ]);

        return response()->json(['success' => true, 'url' => $url]);
    }

    public function hotel_slider_getFile(Request $request)
    {
        $t = time();
        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.$t.'.'.$extension;

        Storage::disk('s3')->put('hotel/slider/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageUrl = Storage::disk('s3')->url('hotel/slider/'.$filenametostore);

        return $imageUrl . ' ' . $t; // igual que destinos
    }



    public function hotel_imagen_deleteFile(Request $request)
    {
        $id_file = $request->get('id_file'); // el src completo que llega del frontend

        $filename = explode('hotels/', $id_file)[1];
        Storage::disk('s3')->delete('hotels/' . $filename);

        return $filename;
    }

    public function hotel_slider_form_delete(Request $request)
    {
        $id_imagen = $request->get('id_hotel_imagen');
        $id_hotel = $request->get('id_hotel');

        $imagen = THotelImagen::find($id_imagen);
        $filename = explode('hotels/slider/', $imagen->nombre)[1];
        Storage::disk('s3')->delete('hotels/slider/' . $filename);

        THotelImagen::where('id', $id_imagen)->delete();

        return redirect(route('admin_hotels_edit_path', $id_hotel))->with('delete', 'Image successfully removed');
    }

    public function deleteHotelGalleryImage(Request $request)
    {
        $imagen = THotelImagen::find($request->imagen_id);

        if ($imagen) {
            $filename = explode('hotels/slider/', $imagen->imagen);
            $filename = $filename[1];
            Storage::disk('s3')->delete('hotels/slider/' . $filename);

            $imagen->delete();
        }

        return back()->with('delete', 'Imagen eliminada con éxito');
    }

    public function image_hotel_gallery_store(Request $request)
    {
        $idhotel = $request->get('idhotel');

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('hotels/slider/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageUrl = Storage::disk('s3')->url('hotels/slider/'.$filenametostore);

        $hotelImage = new \App\THotelImagen();
        $hotelImage->imagen = $imageUrl;
        $hotelImage->idhotel = $idhotel;
        $hotelImage->save();

        return response()->json(['success' => $imageUrl]);
    }

}

