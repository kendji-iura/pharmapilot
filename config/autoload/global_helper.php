<?php


//Para os fãs de laravel, agora o Zend 3 também tem dd!
function dd($whatever)
{
    dump($whatever);
    exit;
    
}

function sim()
{
    dd('sim');
    exit;
    
}

//Cria um modal simples com uma listagem de erros, para ser usado com bootstrap 5
function generateErrorModal(string $title, Array $errors)
{

$message = '<div class="alert alert-danger d-flex alert-dismissible fade show" role="alert">';
$message .= "<strong>$title</strong> ";
$message .= '<ul>';
foreach ($errors as $error) {
    $message .= "<li>$error</li>";
}
$message .= '</ul>';
$message .= '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
$message .= '</div>';

return $message;

}

function fDate(string $data)
    {
        $datetime = new DateTime($data);
        try {
            $formatado = $datetime->format('d/m/Y');
        } catch (\Throwable $th) {
            return $data;
        }        
        return $formatado;
    }

    function pluck(array $array, string $chave): array {
        $result = [];
        foreach ($array as $key) {
            $result[$key[$chave]] = $key;
        }
        return $result;
    }
