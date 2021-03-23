<?php

    namespace App\Services;
    use App\Models\Agenda;

    class AgendaService
    {

        public function createLabAgenda()
        {
            $data = $_POST;

            $data_send = [
                "empresa" => $data['empresa'],
                "de" => $data['dia_inicial'] .' Feira - '.$data['hora_inicial'],
                "ha" => $data['dia_final'] .' Feira - '.$data['hora_final'],
                "exame" => (isset($data['mdlAgendaExame']) ? $data['mdlAgendaExame'] : null)
            ];

            return (new Agenda())->createLabAgenda($data_send);

        }
    }