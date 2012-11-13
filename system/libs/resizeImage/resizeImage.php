<?php

class resizeImage
{


   

    function createThumb($sImagenUrl,$sImagenName, $nWidth = false, $nHeight = false,$thumImagen)
    {
        // Variables
        $sNombre = null;
        $sPath = null;
        $sExt = null;
        $aImage = null;
        $aThumb = null;
        $aImageMarco = null;
        $ImTransparente = null;
        $aSize = null;
        $nWidthMarco = false;
        $nWidthHeight = false;
        $nX = false;
        $nY = false;

        // Obtenemos el nombre de la imagen
        // $sNombre = basename( $sImagen );
        // Obtenemos la ruta especificada para buscar la imagen
        $sPath = dirname( $sImagenUrl );
        $thumPath = dirname($thumImagen);
        // Obtenemos la extension de la imagen

        
        $sImagenExt=substr(strrchr($sImagenName, '.'), 1);
        $sNombre =str_replace(".".$sImagenExt, "", $sImagenName);

        $sExt=$sImagenExt;
        //$sExt = mime_content_type( $sImagen );

        // Creamos el directorio thumbs
        if( ! is_dir( $thumPath ) )
            die('No se ha detectado el directorio "' . $thumPath) ;

         // Creamos la imagen a partir del tipo
        switch( $sExt )
        {
            // Imagen JPG
            case 'jpeg':
                $aImage = @imageCreateFromJpeg( $sImagenUrl.$sImagenName );
                break;
            // Imagen JPG
            case 'jpg':

                $aImage = @imageCreateFromJpeg( $sImagenUrl.$sImagenName );
                break;    
            // Imagen GIF
            case 'gif':
                $aImage = @imageCreateFromGif( $sImagenUrl.$sImagenName );
                break;
            // Imagen PNG
            case 'png':
                $aImage = @imageCreateFromPng( $sImagenUrl.$sImagenName );
                break;
            // Imagen BMP
            case 'wbmp':
                $aImage = @imageCreateFromWbmp( $sImagenUrl.$sImagenName );
                break;
            default:
                return 'No se conoce el tipo de imagen enviado, por favor cambie el formato. Sólo se permiten imágenes *.jpg, *.gif, *.png ó *.bmp.';
                break;
        }
       
       

        // Obtenemos el tamaño de la imagen original
        $aSize = getImageSize( $sImagenUrl.$sImagenName );
        
        // Calculamos las proporciones de la imagen //

        // Obteniendo el alto (Recogiendo ancho y no alto)
        if( $nWidth != false && $nHeight == false )
            $nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
        // Obteniendo el ancho (Recogiendo alto y no ancho)
        elseif( $nWidth == false && $nHeight != false )
            $nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
        // Obteniendo proporciones (Recogiendo alto y ancho)
        elseif( $nWidth != false && $nHeight != false )
        {
            // Guardamos las dimensiones del marco
            $nWidthMarco = $nWidth;
            $nHeightMarco = $nHeight;

            // Si el ancho es mayor
            if( $nWidth < $nHeight )
            {
                $nHeight = round( ( $aSize[1] * $nWidth ) / $aSize[0] );
                $nX = 0;
                $nY = round( ( $nHeightMarco - $nHeight ) / 2 );
            }
            // Si el alto es mayor
            elseif( $nHeight < $nWidth )
            {
                $nWidth = round( ( $aSize[0] * $nHeight ) / $aSize[1] );
                $nX = round( ( $nWidthMarco - $nWidth ) / 2 );;
                $nY = 0;
            }
        }
        // El ancho y el alto no se han enviado, informamos del error
        elseif( $nWidth === false && $nHeight === false )
            return 'No se ha especificado ningún valor para el ancho y el alto de la imágen.';


        // La nueva imagen reescalada
        $aThumb = imageCreateTrueColor( $nWidth, $nHeight );

        // Reescalamos
        imageCopyResampled( $aThumb, $aImage, 0, 0, 0, 0, $nWidth, $nHeight, $aSize[0], $aSize[1] );

        // Si tenemos que crear el marco
        if( $nWidthMarco !== false && $nHeightMarco !== false )
        {
            // El marco
            $aImageMarco = imageCreateTrueColor( $nWidthMarco, $nHeightMarco );

            // Establecemos la imagen de fondo transparente
            imageAlphaBlending( $aImageMarco, false );
            imageSaveAlpha( $aImageMarco, true );

            // Establecemos el color transparente (negro)
            $ImTransparente = imageColorAllocateAlpha( $aImageMarco, 0, 0, 0, 0xff/2 );

            // Ponemos el fondo transparente
            imageFilledRectangle( $aImageMarco, 0, 0, $nWidthMarco, $nHeightMarco, $ImTransparente );

            // Combinamos las imagenes
            imageCopyResampled( $aImageMarco, $aThumb, $nX, $nY, 0, 0, $nWidth, $nHeight, $nWidth, $nHeight );

            // Cambiamos la instancia
            $aThumb = $aImageMarco;
        }

        // Salvamos
        $nameDirectoryThum=substr(strrchr($thumImagen, '/'), 1);
        
        imagePng( $aThumb, $thumPath . "/" . $nameDirectoryThum . "/" . $sNombre.".".$sExt );

        // Liberamos
        imageDestroy( $aImage );
        imageDestroy( $aThumb );

        return true;
    }

}

?>