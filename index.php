<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Contato</title>
        <?php include_once 'contato.php';
        
        ?>
    </head>
    <body>
        <?php
        $form = new contato;
        
        if(isset($_POST['enviar']))
        {
            $form->getDados();
            $form->validar();
            $form->enviaEmail();
        }
        ?>
    </body>
</html>