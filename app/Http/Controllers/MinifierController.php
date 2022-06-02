<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MatthiasMullie\Minify\CSS as MinifyCSS;
use MatthiasMullie\Minify\JS as MinifyJS;

class MinifierController extends Controller
{
    public function __construct()
    {
        // ..
    }

    public function minify( $file ) {
        $files = filter_input(INPUT_GET, '_f');
        if( $files != 'all' ) {
            $files = explode(',', base64_decode($files));

            if( !is_array($files) || count( $files ) < 0 ) {
                return false;
            }
        }
        
        switch ($file) {
            case 'all.js':
                return $this->__minifyJs('render', $files);
                break;
            case 'all.css':
                return $this->__minifyCss('render', $files);
                break;
            default:
                return false;
                break;
        }
    }

    public function minifySave() {
        $this->__minifyJs( 'save', 'all' );
        $this->__minifyCss( 'save', 'all' );
    }

    private function __minifyJs( $action, $files ) {
        $path = public_path('/frontend/assets/js/');
        $minifier = new MinifyJS;
        if( $files == 'all' ) {
            $files = [
                'jquery.min.js',
                'jquery.touchSwipe.min.js',
                'bootstrap.min.js',
                'jplist.min.js',
                'slick.min.js',
                'jplist.min.js',
                'wow.min.js',
                'main.js',
                'custom.js',
                'urbanenigma-slider.js'
            ];
        }
        foreach( $files as $file ) {
            if( file_exists( $path . $file ) ) {
                $minifier->add( $path . $file );
            }
            else {
                echo 'File ' . $path . $file . ' does not exist.<br>\r\n';
            }
        }

        if( $action == 'save' ) {
            if( file_exists( $path . 'all.min.js' ) ) {
                @unlink( $path . 'all.min.js' );
            }
            if( $minifier->minify( $path . 'all.min.js') ) {
                echo $path . 'all.min.js CREATED!';
            }
            if( file_exists( $path . 'all-gzipped.min.js' ) ) {
                @unlink( $path . 'all-gzipped.min.js' );
            }
            if( $minifier->gzip( $path . 'all-gzipped.min.js') ){
                echo $path . 'all-gzipped.min.js CREATED!';
            }
        }
        else {
            header('Content-Type: text/javascript');
            echo $minifier->minify();
        }

    }

    private function __minifyCss( $action, $files ) {
        $path = public_path('/frontend/assets/css/');
        $minifier = new MinifyCSS;
        if( $files == 'all' ) {
            $files = [
                'bootstrap.min.css',
                'font-awesome.min.css',
                'slick.css',
                'animate.css',
                'style.css'
            ];
        }

        foreach( $files as $file ) {
            if( file_exists( $path . $file ) ) {
                $minifier->add( $path . $file );
            }
            else {
                echo 'File ' . $path . $file . ' does not exist.<br>\r\n';
            }
        }

        if( $action == 'save' ) {
            if( file_exists( $path . 'all.min.css' ) ) {
                @unlink( $path . 'all.min.css' );
            }
            if( $minifier->minify( $path . 'all.min.css') ) {
                echo $path . 'all.min.css CREATED!';
            }
        }
        else {
            header('Content-type: text/css');
            echo $minifier->minify();
        }
    }
}
