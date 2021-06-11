<?php

namespace App\Http\Controllers\admin;

use App\TCategoria;
use App\TDestino;
use App\TDestinoImagen;
use App\TPaquete;
use App\TPaqueteImagen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DestinationsController extends Controller
{
    public function index()
    {
        $destinations = TDestino::paginate(10);
        return view('admin.destinations', compact('destinations'));
    }

    public function create()
    {
        $host = $_SERVER["HTTP_HOST"];
        return view('admin.destinations-create', compact('host'));
    }

    public function store(Request $request)
    {
        if ($request->filled(['txt_destination', 'txt_country'])){

            $destinations = new TDestino();
            $destinations->nombre = $request->input('txt_destination');
            $destinations->region = $request->input('txt_region');
            $destinations->pais = $request->input('txt_country');
            $destinations->url = $request->input('url');
            $destinations->resumen = $request->input('txta_short');
            $destinations->descripcion = $request->input('txta_extended');
            $destinations->historia = $request->input('txta_history');
            $destinations->geografia = $request->input('txta_geography');

            $destinations->donde_ir = $request->input('txta_get');
            $destinations->atracciones = $request->input('txta_attractions');
            $destinations->entretenimiento = $request->input('txta_entertainment');
            $destinations->gastronomia = $request->input('txta_gastronomy');
            $destinations->fiestas = $request->input('txta_festivals');

            $destinations->estado = '1';
            $destinations->save();

            return redirect(route('admin_destinations_index_path'))->with('status', 'Destination created successfully');

        }else{
            return "false";
        }
    }

    public function edit($id)
    {
        $destinations = TDestino::where('id', $id)->get();
        $host = $_SERVER["HTTP_HOST"];
        return view('admin.destinations-edit', compact('destinations','host'));
    }

    public function update(Request $request, $id)
    {
        if ($request->filled(['txt_destination', 'txt_country'])){

            $destinations = TDestino::FindOrFail($id);
            $destinations->nombre = $request->input('txt_destination');
            $destinations->region = $request->input('txt_region');
            $destinations->pais = $request->input('txt_country');
            $destinations->url = $request->input('url');
            $destinations->resumen = $request->input('txta_short');
            $destinations->descripcion = $request->input('txta_extended');
            $destinations->historia = $request->input('txta_history');
            $destinations->geografia = $request->input('txta_geography');

            $destinations->donde_ir = $request->input('txta_get');
            $destinations->atracciones = $request->input('txta_attractions');
            $destinations->entretenimiento = $request->input('txta_entertainment');
            $destinations->gastronomia = $request->input('txta_gastronomy');
            $destinations->fiestas = $request->input('txta_festivals');

            $destinations->estado = '1';
            $destinations->save();

            return redirect(route('admin_destinations_edit_path', $id))->with('status', 'Successfully updated destination');

        }else{
            return "false";
        }
    }

    public function destroy($id)
    {
        $destinations=TDestino::find($id);
        $destinations->delete();
        return redirect(route('admin_destinations_index_path'))->with('delete', 'Destination successfully removed');
    }


    public function image_destinations_slider_store(Request $request)
    {

        $id_destinations = $request->get('id_destinations_file');

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('destinations/slider/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('destinations/slider/'.$filenametostore);


        $imageUpload = new TDestinoImagen();
        $imageUpload->nombre = $imageName;
        $imageUpload->iddestinos = $id_destinations;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);

    }

    public function image_destinations_slider_delete(Request $request)
    {

        $filename = $request->get('name_file');
        $id_destinations_file = $request->get('id_destinations_file');

        $filename = explode('.', $filename);
        $filename=$filename[0];

        $destino_imagen = TDestinoImagen::where('iddestinos', $id_destinations_file)->where('nombre', 'like', '%'.$filename.'%')->first();

        $filename = explode('destinations/slider/', $destino_imagen->nombre);
        $filename = $filename[1];
        Storage::disk('s3')->delete('destinations/slider/'.$filename);

        TDestinoImagen::where('id', $destino_imagen->id)->delete();

        return $filename;
    }

    public function image_destinations_slider_form_delete(Request $request)
    {
        $id_destinos_imagen = $request->get('id_destinos_imagen');
        $id_destinos = $request->get('id_destinos');

        $destino_imagen = TDestinoImagen::find($id_destinos_imagen);

        $filename = explode('destinations/slider/', $destino_imagen->nombre);
        $filename = $filename[1];
        Storage::disk('s3')->delete('destinations/slider/'.$filename);

        TDestinoImagen::where('id', $id_destinos_imagen)->delete();

        return redirect(route('admin_destinations_edit_path', $id_destinos))->with('delete', 'Image successfully removed');


    }

    public function image_destinations_image_store(Request $request)
    {
        $id_destino = $request->get('id_destinations_file');

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('destinations/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('destinations/'.$filenametostore);



        $imageUpload = TDestino::FindOrFail($id_destino);
        $imageUpload->imagen = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function image_destinations_image_delete(Request $request)
    {
        $id_destinations_file = $request->get('id_destinations_file');
        $destino = TDestino::find($id_destinations_file);

        $filename = explode('destinations/', $destino->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('destinations/'.$filename);

        TDestino::where('id', $id_destinations_file)->update(['imagen' => NULL]);
        return $filename;
    }

    public function image_destinations_image_form_delete(Request $request)
    {
        $id_package_file = $request->get('id_package');
        $id_destino = $request->get('id_destino');

        $destino = TDestino::find($id_destino);

        $filename = explode('destinations/', $destino->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('destinations/'.$filename);

        TDestino::where('id', $id_destino)->update(['imagen' => NULL]);


        return redirect(route('admin_destinations_edit_path', $id_destino))->with('delete', 'Image successfully removed');
    }
}
