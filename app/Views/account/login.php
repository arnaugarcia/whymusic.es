<div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin">
                <span id="reauth-email" class="reauth-email"></span>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
                <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Sign in</button>
            </form><!-- /form -->
            <a href="#" class="forgot-password">
                Forgot the password?
            </a>
        </div><!-- /card-container -->
        <script type="text/javascript">
$( document ).ready(function() {
    // DOM ready

    // Test data
    /*
     * To test the script you should discomment the function
     * testLocalStorageData and refresh the page. The function
     * will load some test data and the loadProfile
     * will do the changes in the UI
     */
    // testLocalStorageData();
    // Load profile if it exits
    loadProfile();
});

/**
 * Function that gets the data of the profile in case
 * thar it has already saved in localstorage. Only the
 * UI will be update in case that all data is available
 *
 * A not existing key in localstorage return null
 *
 */
function getLocalProfile(callback){
    var profileImgSrc      = localStorage.getItem("PROFILE_IMG_SRC");
    var profileName        = localStorage.getItem("PROFILE_NAME");
    var profileReAuthEmail = localStorage.getItem("PROFILE_REAUTH_EMAIL");

    if(profileName !== null
            && profileReAuthEmail !== null
            && profileImgSrc !== null) {
        callback(profileImgSrc, profileName, profileReAuthEmail);
    }
}

/**
 * Main function that load the profile if exists
 * in localstorage
 */
function loadProfile() {
    if(!supportsHTML5Storage()) { return false; }
    // we have to provide to the callback the basic
    // information to set the profile
    getLocalProfile(function(profileImgSrc, profileName, profileReAuthEmail) {
        //changes in the UI
        $("#profile-img").attr("src",profileImgSrc);
        $("#profile-name").html(profileName);
        $("#reauth-email").html(profileReAuthEmail);
        $("#inputEmail").hide();
        $("#remember").hide();
    });
}

/**
 * function that checks if the browser supports HTML5
 * local storage
 *
 * @returns {boolean}
 */
function supportsHTML5Storage() {
    try {
        return 'localStorage' in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}

/**
 * Test data. This data will be safe by the web app
 * in the first successful login of a auth user.
 * To Test the scripts, delete the localstorage data
 * and comment this call.
 *
 * @returns {boolean}
 */
function testLocalStorageData() {
    if(!supportsHTML5Storage()) { return false; }
    localStorage.setItem("PROFILE_IMG_SRC", "//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" );
    localStorage.setItem("PROFILE_NAME", "Arnau Garcia Gallego");
    localStorage.setItem("PROFILE_REAUTH_EMAIL", "arnau.garcia.gallego@gmail.com");
}
</script>
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
           echo HTML::open_div(array("class" => "form-group has-error"));
           echo HTML::label("usuario_nombre_usuario",$message, array("class" => "control-label"));
           echo HTML::close_div();
        }
    }
}
if ($login->isUserLoggedIn() == true) {
    ROUTER::redirect_to_action("account/user");
} else {

	echo ROUTER::create_action_url("account/login");
    echo HTML::open_div(array("id" => "login"));
	echo HTML::open_form( ROUTER::create_action_url('account/login'), "POST","form_login");

	echo HTML::label("usuario_nombre_usuario","Introduce tu nombre de usuario");
	echo HTML::input("text","usuario_nombre_usuario",null,array("placeholder" => "Introduce tu nombre de usuario"));

	echo HTML::label("usuario_contrasena","Introduce tu contraseña");
	echo HTML::input("password","usuario_contrasena",null,array("placeholder" => "········"));

	echo HTML::label("usuario_recuerdame","Recordar session?");
	echo HTML::checkbox("usuario_recuerdame","usuario_recuerdame",false);

	echo HTML::button_HTML5("submit","Entrar!","login");

	echo HTML::close_form();
	echo HTML::close_div();
	echo HTML::br(3);
}
?>