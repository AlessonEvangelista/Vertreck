<?php

    namespace App\Services;
    use App\Models\Financeiro;

    class FinanceiroService
    {
        public function __construct()
        {
            session_start();
        }

        public function UploadGuiasPdf()
        {
            $target_dir = "../././public/uploads/";
            $_SESSION['pagina_back'] = 'BAIXA EM EXAMES';

            try {
                if(!is_dir($target_dir.$_SESSION['empresa'])) {
                    mkdir($target_dir.$_SESSION['empresa'], 0777, true);
                }
                $target_dir = $target_dir.$_SESSION['empresa'];
                $renameFile = $_SESSION['empresa']."_".basename( $_FILES['formFileGuia']['name'] )."_".date("d_m_Y_H-i-s");

                $file_guia_ext = explode(".", $_FILES["formFileGuia"]['name']);

                if($file_guia_ext[1] !== "pdf") {
                    throw new \Exception("Aquivo deve ser PDF");
                }
                if(move_uploaded_file( $_FILES["formFileGuia"]['tmp_name'], $target_dir ."/". "guia_".$renameFile ))
                {
                    (new Financeiro())->saveUploadFile(['tipo' => 1, 'name' => "guia_".$renameFile ]);
                } else {
                    throw new \Exception("Ocorreu algum erro ao enviar o(s) aquivo(s)");
                }
                if( isset($_FILES["formFileExame"]) ) {
                    if(move_uploaded_file( $_FILES["formFileExame"]['tmp_name'], $target_dir ."/". "exame_".$renameFile ))
                    {
                        (new Financeiro())->saveUploadFile(['tipo' => 2, 'name' => "exame_".$renameFile ]);
                    }
                }

                (new Financeiro())->concluirBaixa();
                $_SESSION['message'] = "Processo concluído com sucesso";
                if($_SERVER['HTTP_HOST'] === 'localhost'){
                    header("Location:  http://localhost/pessoal/Vertreck/ADM/index.php");
                    exit;
                } else {
                    header("Location:  https://vertreck.net.br/Adm/index.php");
                    exit;
                }
            } catch (\Exception $e) {

                (new Financeiro())->examePendente();
                $_SESSION['message'] = $e->getMessage();
                $_SESSION['message_tipo']=3;
                if($_SERVER['HTTP_HOST'] === 'localhost'){
                    header("Location:  http://localhost/pessoal/Vertreck/ADM/index.php");
                    exit;
                } else {
                    header("Location:  https://vertreck.net.br/Adm/index.php");
                    exit;
                }
            }
        }
    }