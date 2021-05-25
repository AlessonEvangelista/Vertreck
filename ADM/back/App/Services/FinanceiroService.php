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
                $renameFile = $_SESSION['empresa']."_data_".date("d_m_Y_H-i-s")."_".basename( $_FILES['formFileLaudo']['name'] );

                $file_laudo_ext = explode(".", $_FILES["formFileLaudo"]['name']);

                if($file_laudo_ext[1] !== "pdf") {
                    throw new \Exception("Aquivo deve ser PDF");
                }
                if(move_uploaded_file( $_FILES["formFileLaudo"]['tmp_name'], $target_dir ."/". "laudo_".$renameFile ))
                {
                    (new Financeiro())->saveUploadFile(['tipo' => 1, 'name' => "laudo_".$renameFile ]);
                } else {
                    throw new \Exception("Ocorreu algum erro ao enviar o(s) aquivo(s)");
                }
                if( isset($_FILES["formFileNota"]) ) {
                    $renameFile = $_SESSION['empresa']."_data_".date("d_m_Y_H-i-s")."_".basename( $_FILES['formFileNota']['name'] );
                    if(move_uploaded_file( $_FILES["formFileNota"]['tmp_name'], $target_dir ."/". "nota_".$renameFile ))
                    {
                        (new Financeiro())->saveUploadFile(['tipo' => 2, 'name' => "nota_".$renameFile ]);
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