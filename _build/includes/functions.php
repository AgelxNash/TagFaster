<?php
/**
* defaultcomponent
*
* Copyright 2010-11 by SCHERP Ontwikkeling <info@scherpontwikkeling.nl>
*
* This file is part of defaultComponent, a simple commenting component for MODx Revolution.
*
* defaultComponent is free software; you can redistribute it and/or modify it under the
* terms of the GNU General Public License as published by the Free Software
* Foundation; either version 2 of the License, or (at your option) any later
* version.
*
* defaultComponent is distributed in the hope that it will be useful, but WITHOUT ANY
* WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
* A PARTICULAR PURPOSE. See the GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License along with
* defaultComponent; if not, write to the Free Software Foundation, Inc., 59 Temple Place,
* Suite 330, Boston, MA 02111-1307 USA
*
* @package defaultcomponent
*/
/**
* @package defaultcomponent
* @subpackage build
*/
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    $o = str_replace('<?php','',$o);
    $o = str_replace('?>','',$o);
    $o = trim($o);
    return $o;
}

class MT{
    static $start;
    static function show($msg, $file, $line, $time){
        $time = ($time - self::$start);
        if(self::CheckCnt('web')){
            echo "{$time} - <strong>{$msg}</strong> at {$file}:{$line}<br />";
        }
    }
	static function end($msg,$file,$line,$time){
		self::show($msg,$file,$line,$time);
		echo "<hr />";
	}
    private static function CheckCnt($cnt){
        global $modx;
        return (is_object($modx) && is_object($modx->context) && $modx->context->get('key')==$cnt && isset($_COOKIE['MT']) && 'debugProfiler'==$_COOKIE['MT']);
    }
}