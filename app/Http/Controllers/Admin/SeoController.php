<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\TSeo;
class SeoController extends Controller
{
    //
    public function store(Request $request)
    {
        if ($request->filled(['txt_title'])){
            $seo = new TSeo();
            $seo->titulo = $request->input('txt_title');
            $seo->descripcion = $request->input('txt_description');
            $seo->url = $request->input('txt_url');
            $seo->og_tipo=$request->input('txt_type');
            $seo->keywords=$request->input('txt_keywords');
            $seo->microdata=$request->input('txt_schema');
            $seo->localizacion=$request->input('txt_locale');
            $seo->nombre_sitio=$request->input('txt_siteName');
            $seo->imagen_width=$request->input('txt_imageWidth');
            $seo->imagen_height=$request->input('txt_imageHeight');
            $seo->imagen=$request->input('id_seo_file');
            $seo->estado=0;
            $seo->id_t=$request->input('text_idt');
            $seo->save();

            return redirect(route('admin_blog_edit_path',$seo->id_t))->with('status', 'SEO created successfully');

        }else{
            return "false";
        }
    }

    public function update(Request $request, $id)
    {

        if ($request->filled(['txt_title'])){

            $seo = TSeo::FindOrFail($id);
            $seo->titulo = $request->input('txt_title');
            $seo->descripcion = $request->input('txt_description');
            $seo->url = $request->input('txt_url');
            $seo->og_tipo=$request->input('txt_type');
            $seo->keywords=$request->input('txt_keywords');
            $seo->microdata=$request->input('txt_schema');
            $seo->localizacion=$request->input('txt_locale');
            $seo->nombre_sitio=$request->input('txt_siteName');
            $seo->imagen_width=$request->input('txt_imageWidth');
            $seo->imagen_height=$request->input('txt_imageHeight');
            $seo->save();
            $post=$request->input('text_idt');
            return redirect(route('admin_blog_edit_path', $post))->with('status2', 'Successfully updated SEO');

        }else{
            return "false";
        }
    }

    public function destroy($id)
    {
        $seo=TSeo::find($id);

        if ($seo->imagen != NULL) {
            $filename = explode('seo/blog/', $seo->imagen);
            $filename = $filename[1];
            Storage::disk('s3')->delete('seo/blog/' . $filename);
            TSeo::where('id', $id)->update(['imagen' => NULL]);
        }
        $seo->delete();
        return redirect(route('admin_blog_index_path'))->with('delete2', 'SEO successfully removed');
    }
    public function seo_blog_image_store(Request $request)
    {
        $id_seo = $request->get('id_seo');
        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;
        
        Storage::disk('s3')->put('seo/blog/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('seo/blog/'.$filenametostore);
        
        $imageUpload = TSeo::FindOrFail($id_seo);
        $imageUpload->imagen = $imageName;
        $imageUpload->save();

        return response()->json(['success' => $imageName]);
    }
    public function seo_blog_image_delete(Request $request)
    {
        $id_seo = $request->get('id_seo');
        $seo = TSeo::find($id_seo);

        $filename = explode('seo/blog/', $seo->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('seo/blog/'.$filename);

        TSeo::where('id', $id_seo)->update(['imagen' => NULL]);
        return $filename;
    }
    public function seo_blog_image_form_delete(Request $request)
    {
        $id_seo = $request->get('id_seo');
        $seo = TSeo::find($id_seo);

        $filename = explode('seo/blog/', $seo->imagen);
        $filename = $filename[1];
        Storage::disk('s3')->delete('seo/blog/'.$filename);

        TSeo::where('id', $id_seo)->update(['imagen' => NULL]);
        return redirect(route('admin_blog_edit_path', $seo->id_t))->with('status3', 'Image SEO successfully removed');
    }
    public function seo_blog_imagen_getFile(Request $request){
        $filenamewithextension = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $filenametostore = $filename.'_'.time().'.'.$extension;
        
        Storage::disk('s3')->put('seo/blog/'.$filenametostore, fopen($request->file('file'), 'r+'), 'public');
        $imageName = Storage::disk('s3')->url('seo/blog/'.$filenametostore);
        return $imageName;
    }
    public function seo_blog_imagen_deleteFile(Request $request){
        
        $id_blog_file = $request->get('id_seo_file');
        error_log($id_blog_file);
        $filename = explode('seo/blog/', $id_blog_file);
        $filename = $filename[1];
        Storage::disk('s3')->delete('seo/blog/'.$filename);

        return $filename;
    }

}
