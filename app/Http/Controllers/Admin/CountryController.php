<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\TDestino;
use App\TDestinoImagen;
use App\TPais;
use App\TPaisImagen;
use App\TSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountryController extends Controller
{
    public function index()
    {
        $country = TPais::all();
        $seo=TSeo::where('estado', 2)->get();
        return view('admin.country', compact('country','seo'));
    }
    public function create()
    {
        $host = $_SERVER["HTTP_HOST"];
        return view('admin.country-create', compact('host'));
    }

    public function store(Request $request)
    {
        if ($request->filled(['txt_country'])){

            $destinations = new TPais();
            $destinations->nombre = $request->input('txt_country');
            $destinations->url = $request->input('url');
            $destinations->resumen = $request->input('txta_short');
            $destinations->descripcion = $request->input('txta_extended');
            $destinations->imagen=$request->input('id_blog_file');
            $destinations->imagen_s=$request->input('id_blog_file');

            $destinations->clima = $request->input('txta_weather');
            $destinations->recomendaciones = $request->input('txta_recommend');

            $destinations->historia = $request->input('txta_history');
            $destinations->geografia = $request->input('txta_geography');

            $destinations->donde_ir = $request->input('txta_get');
            $destinations->atracciones = $request->input('txta_attractions');
            $destinations->entretenimiento = $request->input('txta_entertainment');
            $destinations->gastronomia = $request->input('txta_gastronomy');
            $destinations->fiestas = $request->input('txta_festivals');

            $destinations->estado = '1';
            $destinations->save();

            $desti_recover=TPais::latest()->first();
            $seo_atributos=$request->input('seo_atributos');
            $imagen_seo=$request->input('imagen_seo2');
            if($seo_atributos!=null){
                $porciones = explode(",", $seo_atributos);
                $seo = new TSeo();
                $seo->titulo=$porciones[0];
                $seo->descripcion = $porciones[1];
                $seo->url = $porciones[2];
                $seo->og_tipo=$porciones[3];
                $seo->keywords=$porciones[4];
                $seo->microdata=$porciones[5];
                $seo->localizacion=$porciones[6];
                $seo->nombre_sitio=$porciones[7];
                $seo->imagen=$imagen_seo;
                if($porciones[8]==null){
                    $seo->imagen_width=null;
                }else{
                    $seo->imagen_width=$porciones[8];
                }
                if($porciones[9]==null){
                    $seo->imagen_height=null;
                }else{
                    $seo->imagen_height=$porciones[9];
                }

                $seo->estado=2;
                $seo->id_t=$desti_recover->id;
                $seo->save();
            }
            $imagenes=$request->input('id_blog_file2');
            if($imagenes!=null){
                $porciones = explode(",", $imagenes);
                foreach($porciones as $key) {
                    $imageUpload = new TPaisImagen();
                    $imageUpload->nombre = $key;
                    $imageUpload->idpais = $desti_recover->id;
                    $imageUpload->save();
                }
            }

            return redirect(route('admin_countries_index_path'))->with('status', 'Destination created successfully');

        }else{
            return "false";
        }
    }

    public function edit($id)
    {
        $countries = TPais::where('id', $id)->get();
        $host = $_SERVER["HTTP_HOST"];
        $seo=TSeo::where('estado', 2)->where('id_t',$id)->get()->first();
        return view('admin.country-edit', compact('countries','host','seo'));
    }

    public function update(Request $request, $id){

        if ($request->filled(['txt_country'])){

            $destinations = TPais::FindOrFail($id);
            $destinations->nombre = $request->input('txt_country');
            $destinations->url = $request->input('url');
            $destinations->resumen = $request->input('txta_short');
            $destinations->descripcion = $request->input('txta_extended');

            $destinations->clima = $request->input('txta_weather');
            $destinations->recomendaciones = $request->input('txta_recommend');

            $destinations->historia = $request->input('txta_history');
            $destinations->geografia = $request->input('txta_geography');

            $destinations->donde_ir = $request->input('txta_get');
            $destinations->atracciones = $request->input('txta_attractions');
            $destinations->entretenimiento = $request->input('txta_entertainment');
            $destinations->gastronomia = $request->input('txta_gastronomy');
            $destinations->fiestas = $request->input('txta_festivals');

            $destinations->estado = '1';
            $destinations->save();

            return redirect(route('admin_countries_edit_path', $id))->with('status', 'Successfully updated destination');

        }else{
            return "false";
        }
    }

    public function destroy($id)
    {
        $countries=TPais::find($id);

        if ($countries->imagen != NULL) {
            $filename = explode('countries/', $countries->imagen);
            $filename = $filename[1];
            Storage::disk('s3')->delete('countries/' . $filename);
            TPais::where('id', $id)->update(['imagen' => NULL]);
        }

        $destino_imagen = TPaisImagen::where('idpais', $id)->get();
        $destino_imagen_1 = TPaisImagen::where('idpais', $id)->first();

        if ($destino_imagen_1){
            foreach ($destino_imagen as $destino_aws) {
                $filename = explode('countries/slider/', $destino_aws->nombre);
                $filename = $filename[1];
                Storage::disk('s3')->delete('countries/slider/'.$filename);
                TPaisImagen::where('id', $destino_imagen_1->id)->delete();
            }
        }


        $countries->delete();
        $postsEO=TSeo::where('estado',2)->where('id_t', $id)->first();
        if($postsEO!=null){
            if ($postsEO->imagen != NULL) {
                $filename = explode('seo/countries/', $postsEO->imagen);
                $filename = $filename[1];
                Storage::disk('s3')->delete('seo/countries/' . $filename);
                TSeo::where('id', $id)->update(['imagen' => NULL]);
            }
            $postsEO->delete();
        }
        return redirect(route('admin_countries_index_path'))->with('delete', 'Destination successfully removed');
    }

    public function countries_imagen_getFile(Request $request){
        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('countries/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('countries/'.$filenametostore);
        return $imageName;
    }
    public function countries_imagen_deleteFile(Request $request){
        $id_blog_file = $request->get('id_blog_file');

        $filename = explode('countries/', $id_blog_file);
        $filename = $filename[1];
        Storage::disk('s3')->delete('countries/'.$filename);

        return $filename;
    }
    public function countries_slider_getFile(Request $request){
        $t=time();
        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.$t.'.'.$extension;

        Storage::disk('s3')->put('countries/slider/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('countries/slider/'.$filenametostore);
        return $imageName." ".$t;
    }
    public function countries_slider_deleteFile(Request $request){
        $imagenes = $request->get('aux');
        $file_name = $request->get('name_file');
        error_log($imagenes);
        $filename2=explode(".",$file_name);
        $name="";
        $porciones = explode(",", $imagenes);
        foreach($porciones as $key) {
            $part = explode(" ", $key);
            $part2= explode($part[2], $part[0]);
            $part3=explode($part[1],$part2[1]);
            if($part3[0]==($filename2[0].'_')){
                $name=$key;
            }
        }
        $filename = explode('countries/slider/', $name);
        $filename = explode(' ', $filename[1]);
        $filename = $filename[0];
        error_log($filename[1]);
        Storage::disk('s3')->delete('countries/slider/'.$filename);
        return $name;
    }

    //edit image
    public function image_countries_slider_store(Request $request)
    {

        $id_countries = $request->get('id_countries_file');

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('countries/slider/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('countries/slider/'.$filenametostore);


        $imageUpload = new TPaisImagen();
        $imageUpload->nombre = $imageName;
        $imageUpload->idpais = $id_countries;
        $imageUpload->save();
        return response()->json(['success' => $imageName]);

    }

    public function image_countries_slider_delete(Request $request)
    {

        $filename = $request->get('name_file');
        $id_countries_file = $request->get('id_countries_file');

        $filename = explode('.', $filename);
        $filename=$filename[0];

        $pais_imagen = TPaisImagen::where('idpais', $id_countries_file)->where('nombre', 'like', '%'.$filename.'%')->first();

        $filename = explode('countries/slider/', $pais_imagen->nombre);
        $filename = $filename[1];
        Storage::disk('s3')->delete('countries/slider/'.$filename);

        TDestinoImagen::where('id', $pais_imagen->id)->delete();

        return $filename;
    }

    public function image_countries_slider_form_delete(Request $request)
    {
        $id_country_imagen = $request->get('id_country_imagen');
        $id_country = $request->get('id_country');

        $pais_imagen = TPaisImagen::find($id_country_imagen);

        $filename = explode('countries/slider/', $pais_imagen->nombre);
        $filename = $filename[1];
        Storage::disk('s3')->delete('countries/slider/'.$filename);

        TPaisImagen::where('id', $id_country_imagen)->delete();

        return redirect(route('admin_countries_edit_path', $id_country))->with('delete', 'Image successfully removed');


    }

    public function image_countries_image_store(Request $request)
    {
        $id_pais = $request->get('id_countries_file');

        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;

        Storage::disk('s3')->put('countries/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('countries/'.$filenametostore);



        $imageUpload = TPais::FindOrFail($id_pais);
        $imageUpload->imagen = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }

    public function image_countries_image_delete(Request $request)
    {
        $id_countries_file = $request->get('id_countries_file');
        $pais = TPais::find($id_countries_file);

        $filename = explode('countries/', $pais->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('countries/'.$filename);

        TPais::where('id', $id_countries_file)->update(['imagen' => NULL]);
        return $filename;
    }

    public function image_countries_image_form_delete(Request $request)
    {
        $id_package_file = $request->get('id_package');
        $id_pais = $request->get('id_pais');

        $pais = TPais::find($id_pais);

        $filename = explode('countries/', $pais->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('countries/'.$filename);

        TPais::where('id', $id_pais)->update(['imagen' => NULL]);


        return redirect(route('admin_countries_edit_path', $id_pais))->with('delete', 'Image successfully removed');
    }
}
