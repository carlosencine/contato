<?php
/**
 * Class to send E-mail using PHPMailer
 * Data de Criação: 11/02/2014
 * @author Carlos Alexandre Zancki Encine
 */
require 'phpmailer/PHPMailerAutoload.php';

class contato extends PHPMailer {
    public $name,
           $email,
           $subject,
           $message,
           $validation;//second validation from this form
    
    
    function __construct()
    {
        //construct to generate form contact
        echo "<form action=\"\" name=\"contato\" id=\"contato\" method=\"post\" onsubmit=\"return validar(this);\">
            <h2>Contato</h2>
            <input type=\"text\" name=\"nome\" size=\"50\" placeholder=\"Nome\"/><br>
            <input type=\"text\" name=\"email\" size=\"50\" placeholder=\"E-mail\"/><br>
            <input type=\"text\" name=\"assunto\" size=\"50\" placeholder=\"assunto\"/><br>
            <textarea name=\"mensagem\" cols=\"39\" rows=\"10\" placeholder=\"Mensagem\"></textarea><br>
            <input type=\"text\" name=\"validacao\" placeholder=\"A raiz quadrada de 49 é?\"><br>
            <input type=\"submit\" name=\"enviar\" value=\"Enviar\">
            </form>";
    }
    
    function validaform()
    {
        //function Javascript to validate form
        echo "<script type=\"text/javascript\">
	function validar(contato){
		if(contato.nome.value == ''){
			alert(\"Name field should be filled.\");
			return false;
		}
		if(contato.email.value == ''){
			alert(\"E-mail field should be filled\");
			return false;
		}
		if(contato.assunto.value == ''){
			alert(\"Subject field should be filled\");
			return false;
		}
		if(contato.msg.value == ''){
			alert(\"Message field should be filled\");
			return false;
		}
		return true;
	}
</script>";
       
    }
    
    function getData()
    {
        //obtem os dados do formulário via POST
        $this->name = strip_tags($_POST['nome']);
        $this->email = strip_tags($_POST['email']);
        $this->subject = strip_tags($_POST['assunto']);
        $this->message = strip_tags($_POST['mensagem']);
        $this->validation = strip_tags($_POST['validacao']);
    }
    
    function validate()
    {
        if($this->validation != 7)
        {
            echo "Message don´t send";
            exit();
        }
    }
            
    function sendEmail()
    {
        $this->isSMTP();
        $this->SMTPAuth = true;//email autentication
        $this->Host = "";//server
        $this->Port = 587;//port
        $this->Username = "";//user
        $this->Password = "";//pass
        $this->setFrom('', 'name of site');//for those who will be sent 1)adress 2)header of message
        $this->Subject = "Contact sent dare Site";//assunto
        
        $body = "Name: {$this->name}<br>
                 E-mail: {$this->email}<br>
                 Subject:{$this->subject}<br>
                 Message {$this->message}<br>";
        $this->msgHTML($body);//header message
        $this->addAddress("");//redirect from other adress
        
        if(!$this->send())
        {
            echo "<script type=\"text\javascript\">";
            echo "alert(\"unsent message\");";
            echo "</script>";
        } else {
            echo "Message sent successfully";
            
        }
        
    }
}

?>
