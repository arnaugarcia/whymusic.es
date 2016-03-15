<?php
/*Constantes globales de la app*/
define("MESSAGE_REDIRECT", "En pocs segons seràs redirecionat");
define("MESSAGE_CORRECT", "Tot correcte!");
define("MESSAGE_CORRECT_MOD", "Dades modificades amb èxit!");
define("MESSAGE_ERROR_SQL", "Hi ha hagut un error enla consulta SQL, contacti amb l'administrador");
/*Menús y demàs*/
define("MENU_HOME", "Inici");
define("MENU_LOGIN", "Entrar");
define("MENU_REGISTER", "Registre");
define("MENU_LOCALES", "Locals");
define("MENU_MUSICOS", "Músics");
/*Constantes d'error dels formularis */
define('MESSAGE_FORM_NOMBRE_EMPTY', "El camp Nom està buit");
define('MESSAGE_FORM_APELLIDO_EMPTY', "Un dels camps cognom està buit");
define('MESSAGE_FORM_IDIOMA_EMPTY', "El camp idioma no és válid");
define('MESSAGE_FORM_TELEFONO_EMPTY', "El campo teléfono està vacío");
define('MESSAGE_FORM_IDIOMA', "El camp idioma no es correcte");
define('MESSAGE_FROM_NOMBRE_LENGHT', "Nom d'usuari incorrecte, la seva allargada té que ser entre 2 i 64 ");
define('MESSAGE_FORM_NOMBRE_CARACTER', "Nom d'usuari incorrecte, no pot contindre símbols");
define('MESSAGE_FORM_TELEFONO_INVALID', "El camp telèfon ha de ser d'aquest estil (123456789)");
/*Vistas*/
/*Vistas Formaularios campos*/
define("WORDING_NOMBRE", "Nom");
define("WORDING_APELLIDO1", "Primer cognom");
define("WORDING_APELLIDO2", "Segon cognom");
define("WORDING_IDIOMA", 'Idioma');
define("WORDING_TELEFON", 'Telèfon');
define("WORDING_NOMBRE_LOCAL", "Nom local:");
define("WORDING_DIRECCION", "Direcció:");
define("WORDING_LATITUD", 'Latitud:');
define('WORDING_LONGITUD', 'Longitud:');
define('WORDING_NOM_LOCAL', 'Local');
define('WORDING_NOM_USUARIOS', 'Usuaris');
define('WORDING_NOM_MUSICOS', "Musicos");
define('WORDING_NOM_FAN', "Fans");
define("WORDING_PROFILE_USERNAME", "Nom d'usuari");
define('WORDING_PROFILE_NOMBRE_LOCAL', "Local");
define('WORDING_PROFILE_APELLIDO1', "Primer cognom");
define('WORDING_PROFILE_APELLIDO2', 'Segon cognom');
define("WORDING_PROFILE_EMAIL", "Email");
define("WORDING_PROFILE_DIRECCION", "Direcció");
define("WORDING_PROFILE_ESTILO","Estil de música");
define("WORDING_NOMBRE_MUSICO","Nom de la banda");




/*Vistas
/*Botones en la applicación*/
define('BUTTON_MOD_DATA', "Modificar dades");



// login & registration classes
define("MESSAGE_ACCOUNT_NOT_ACTIVATED", "El seu compte encara no està activat. Si us plau, feu clic a l'enllaç de confirmació en el correu electrònic.");
define("MESSAGE_CAPTCHA_WRONG", "Captcha incorrecte!");
define("MESSAGE_COOKIE_INVALID", "Cookie no valida");
define("MESSAGE_DATABASE_ERROR", "Problema de connexió amb la base de dades.");
define("MESSAGE_EMAIL_ALREADY_EXISTS", "Aquesta adreça de correu electrònic ja està registrada. Si us plau, utilitza la pàgina \"He oblidat la contrasenya\" si vostè no la recorda.");
define("MESSAGE_EMAIL_CHANGE_FAILED", "Ho sentim. El teu canvi d’adreça electrònica a fallat.");
define("MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "La teva adreça de correu electrònic s’ha canviat correctament. La teva nova adreça de correu electrònic és ");
define("MESSAGE_EMAIL_EMPTY", "L'adreça de correu electrònic no pot estar buida");
define("MESSAGE_EMAIL_INVALID", "La seva adreça de correu electrònic no està en un format de correu electrònic vàlid");
define("MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "Ho sentim, aquesta adreça de correu electrònic és la mateixa que l'actual. Si us plau escolliu-ne una altra.");
define("MESSAGE_EMAIL_TOO_LONG", "L'adreça de correu electrònic no pot tenir més de 64 caràcters");
define("MESSAGE_LINK_PARAMETER_EMPTY", "Dades de paràmetres d'enllaç, buits.");
define("MESSAGE_LOGGED_OUT", "Vostè ha tancat la sessió."); //"Vostè s'ha desconnectat";
// The "login failed"-message is a security improved feedback that doesn't show a potential attacker if the user exists or not
define("MESSAGE_LOGIN_FAILED", "Error d'inici de sessió."); //"Error de connexió";
define("MESSAGE_OLD_PASSWORD_WRONG", "La vostra contrasenya ANTIGA estava malament.");
define("MESSAGE_PASSWORD_BAD_CONFIRM", "La contrasenya i la contrasenya de repetició no són la mateixa (no coincideixen)");
define("MESSAGE_PASSWORD_CHANGE_FAILED", "Ho sentim, el canvi de la seva contrasenya ha fallat.");
define("MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "Contrasenya canviada amb èxit!!");
define("MESSAGE_PASSWORD_EMPTY", "El camp contrasenya estava buit");
define("MESSAGE_PASSWORD_RESET_MAIL_FAILED", "Correu electrònic de restabliment de contrasenya, NO enviat amb èxit! Error: ");
define("MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "Correu electrònic de restabliment de contrasenya, enviat amb èxit!");
define("MESSAGE_PASSWORD_TOO_SHORT", "La contrasenya ha de tenir una longitud mínima de 6 caràcters");
define("MESSAGE_PASSWORD_WRONG", "Contrasenya incorrecta. Intenta-ho de nou.");
define("MESSAGE_PASSWORD_WRONG_3_TIMES", "Ha introduït una contrasenya incorrecta 3 o més vegades. Si us plau, espereu 30 segons per tornar-ho a intentar.");
define("MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "Ho sentim, no s’ha trobat cap combinació de codi id/verificació aquí...");
define("MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "L'activació s’ha realitzat correctament! Ara pot iniciar sessió!"); //"L'activació s’ha realitzat correctament! Ara pot connectar-se!";
define("MESSAGE_REGISTRATION_FAILED", "Ho sentim, el teu registre ha fallat. Si us plau, torna enrere i intenta-ho de nou.");
define("MESSAGE_RESET_LINK_HAS_EXPIRED", "El seu enllaç de restabliment ha expirat. Utilitzeu l'enllaç de restabliment en el transcurs d'una hora.");
define("MESSAGE_VERIFICATION_MAIL_ERROR", "Ho sentim, no hem pogut enviar un correu electrònic de verificació. El teu compte NO ha estat creat.");
define("MESSAGE_VERIFICATION_MAIL_NOT_SENT", "El correu electrònic de verificació NO s'ha enviat correctament! Error: ");
define("MESSAGE_VERIFICATION_MAIL_SENT", "El seu compte ha estat creat amb èxit i li hem enviat un correu electrònic. Si us plau, feu clic a L'ENLLAÇ DE VERIFICACIÓ dins d'aquest correu.");
define("MESSAGE_USER_DOES_NOT_EXIST", "Aquest usuari no existeix");
define("MESSAGE_USERNAME_BAD_LENGTH", "El nom d'usuari no pot ser inferior a 2 o superior a 64 caràcters");
define("MESSAGE_USERNAME_CHANGE_FAILED", "Ho sentim, el canvi de nom del seu nom d'usuari triat a fallat");
define("MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "El seu nom d'usuari s'ha canviat correctament. El nou nom d'usuari és ");
define("MESSAGE_USERNAME_EMPTY", "El camp usuari estava buit");
define("MESSAGE_USERNAME_EXISTS", "Ho sentim, aquest nom d'usuari ja està en ús. Si us plau escolliu-ne un altre.");
define("MESSAGE_USERNAME_INVALID", "El nom d'usuari no s'ajusta a l'estructura de noms: només a-Z i els números estan permesos, de 2 a 64 caràcters");
define("MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "Ho sentim, aquest nom d'usuari és el mateix que l'actual. Si us plau trieu-ne un altre.");
define("MESSAGE_TIPO_USUARIO", 'El tipus de usuari no coincideix.');

// views
define("WORDING_BACK_TO_LOGIN", "Tornar a la pàgina d'inici de sessió");
define("WORDING_CHANGE_EMAIL", "Canviar correu electrònic");
define("WORDING_CHANGE_PASSWORD", "Canviar la contrasenya");
define("WORDING_CHANGE_USERNAME", "Canviar nom d'usuari");
define("WORDING_CURRENTLY", "actualment");
define("WORDING_EDIT_USER_DATA", "Edita dades d'usuari");
define("WORDING_EDIT_YOUR_CREDENTIALS", "Vostè està connectat i pot editar els teus credencials aquí");
define("WORDING_FORGOT_MY_PASSWORD", "He oblidat la contrasenya");
define("WORDING_LOGIN", "Iniciar sessió");
define("WORDING_LOGOUT", "Finalitzar sessió");
define("WORDING_NEW_EMAIL", "Nou correu electrònic");
define("WORDING_NEW_PASSWORD", "Nova contrasenya");
define("WORDING_NEW_PASSWORD_REPEAT", "Repeteix la nova contrasenya");
define("WORDING_NEW_USERNAME", "Nou nom d'usuari (el nom d'usuari no pot estar buit i ha de ser azAZ09 i 2-64 caràcters)");
define("WORDING_OLD_PASSWORD", "La vostra contrasenya ANTIGA");
define("WORDING_PASSWORD", "Contrasenya");
define("WORDING_PROFILE_PICTURE", "La seva foto de perfil (de gravatar):");
define("WORDING_REGISTER", "Registrar");
define("WORDING_REGISTER_NEW_ACCOUNT", "Registrar un nou compte");
define("WORDING_REGISTRATION_CAPTCHA", "Si us plau entra aquests caràcters");
define("WORDING_REGISTRATION_EMAIL", "Correu electrònic de l'usuari (si us plau proporcioni una adreça de correu electrònic real, obtindrà un correu de verificació amb un enllaç d'activació)");
define("WORDING_REGISTRATION_PASSWORD", "Contrasenya (min. 6 caràcters!)");
define("WORDING_REGISTRATION_PASSWORD_REPEAT", "Repetir contrasenya");
define("WORDING_REGISTRATION_USERNAME", "Nom d'usuari (només lletres i números, 2-64 caràcters)");
define("WORDING_REMEMBER_ME", "Mantén-me connectat (durant 2 setmanes)"); //"No tancar sessió (durant 2 setmanes)";
define("WORDING_REQUEST_PASSWORD_RESET", "Sol·licitar un restabliment de contrasenya. Introdueixi el seu nom d'usuari i obtindràs un correu electrònic amb les instruccions:");
define("WORDING_RESET_PASSWORD", "Canviar la contrasenya");
define("WORDING_SUBMIT_NEW_PASSWORD", "Enviar contrasenya nova");
define("WORDING_USERNAME", "Nom d'usuari");
define("WORDING_YOU_ARE_LOGGED_IN_AS", "Has iniciat la sessió com a "); //"T'has connectat com a";

//constants pròpies
?>
