<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Inclui o autoload do Composer para carregar as dependências do PHPMailer
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Recebe dados do form
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Cria uma nova instância do PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP do Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'seuemail@gmail.com';  // Substitua pelo seu e-mail
        $mail->Password = 'suasenha';  // Substitua pela sua senha de e-mail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurações do e-mail
        $mail->setFrom('seuemail@gmail.com', 'Nome do Remetente');  // 
        $mail->addAddress('destinatario@dominio.com');  

        // Define o formato do e-mail como HTML
        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem de contato';
        $mail->Body = "<p><strong>Nome:</strong> $name</p><p><strong>E-mail:</strong> $email</p><p><strong>Mensagem:</strong> $message</p>";

        // Envia o e-mail
        $mail->send();
        echo 'Mensagem enviada com sucesso!';
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
}
?>
