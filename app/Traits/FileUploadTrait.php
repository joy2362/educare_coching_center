<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait FileUploadTrait {
    //do somthing useful

     /*-----IMAGE UPLOAD-----*/
     protected function upload( $file, $path, $old = null ) {
        
        $code = date( 'ymdhis' ) . '-' . rand( 1111, 9999 );

        /*-------DELETE OLD IMAGE-------*/
        if ( !empty( $old ) ) {
            $oldFile = $this->oldFile( $old );
            if ( Storage::disk( 'public' )->exists( $oldFile ) ):
            Storage::delete( $oldFile );
            endif;
        }

        /*-------FILE/IMAGE UPLOAD-------*/
        if ( !empty( $file ) ) {
            $fileName = $code ."." . $file->getClientOriginalExtension();
            $this->makeDir($path);
            return Storage::putFileAs( 'upload/' . $path, $file, $fileName );
        }

     }

    /*-----Folder Create-----*/
    public function makeDir( $folder, $subfolder = null ) {
        $main_dir = storage_path( "app/public/upload/{$folder}" );
        if ( $subfolder ) {
            $main_dir = storage_path( "app/public/upload/{$folder}/{$subfolder}" );
        }

        if ( !file_exists( $main_dir ) ) {
            mkdir( $main_dir, 0777, true );
        }
    }

    /*-----OLD IMAGE-----*/
    public function oldFile( $file ) {
        $ex = explode( 'storage/', $file );
        return $ex[1] ?? "";
    }

     /*-----delete file-----*/
     public function deleteFile( $file ) {
        if ( Storage::disk( 'public' )->exists( $file ) ):
        Storage::delete( $file );
        endif;
     }



}
