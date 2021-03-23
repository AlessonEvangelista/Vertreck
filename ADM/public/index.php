<?php
$baseUrl = $_SERVER['HTTP_HOST'] .'/'. $_SERVER['REQUEST_URI'];
$pathParts = pathinfo($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);

define("_FILE_ATUAL_", $pathParts['basename']);
define("_BASE_URL_", str_replace($pathParts['basename'], "", $baseUrl) );
?>
<html>
    <header></header>
    <body style="background-color: #cdcdcd">
        <div style="width: 400px; min-height: 200px; margin: 0 auto;">
            <div style="width: 180px; margin: 2px 10px;">
                <div>
                    <button style="border-radius: 5px; background-color: #00adee; color: #f0f0f0; padding: 10px 15px;">
                        <a href="http://<?= _BASE_URL_?>/Adm"> ADM </a>
                    </button>
                </div>
            </div>
        </div>
    </body>
</html>