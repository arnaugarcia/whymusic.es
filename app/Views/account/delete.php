<?php
$login = new ModelLogin();
if(isset($login)) {
    if($login->errors) {
        foreach ($login->errors as $error) {
            echo HTML::open_div(array("class" => "form-group has-error"));
            echo HTML::label("usuario_nombre_usuario",$error, array("class" => "control-label"));
            echo HTML::close_div();
        }
    }
    if($login->messages) {
        foreach ($login->messages as $message) {
            echo HTML::open_div(array("class" => "form-group has-success", "style" => "text-align: center"));
            echo HTML::label("inputSuccess1", $message, array("class" => "control-label"));
            echo HTML::close_div();
        }
    }
}
?>
<h3>Esta seguro de eliminar su cuenta?</h3>
<img src="http://cdn.meme.am/instances/500x/60053646.jpg">
<?php
echo HTML::open_form(ROUTER::create_action_url("account/delete"),"POST","delete_user");
echo HTML::input("submit","delete_user","Eliminar cuenta :(",array("class"=>"btn btn-danger"));
echo HTML::close_form();
 ?>