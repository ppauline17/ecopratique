<?php
    require_once("_header.php");

    if (empty($_SESSION['user_id'])) {
        header("location:./accueil");
    } else {
        $req=$db->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $req->bindValue('user_id', $_SESSION['user_id'], PDO::PARAM_STR);
        $req->execute();
        $user=$req->fetch(PDO::FETCH_ASSOC);
?>

    <section class="mt-5 pt-5">
        <div class="container">
            <h3>Mon compte</h3>
            <div class="row">
                <div class="col-md-4 offset-md-4 mt-5 mb-5">
                    <div class="card p-3">
                        <div class="card-body">
                            <h4 class="card-title">A propos de moi <button class="btn" data-bs-toggle="modal" data-bs-target="#modalUpdate" title="Modifier mon compte"><?php require('icons/update.php') ?></button></h4>
                            <p class="card-text"><?=$user['firstname']?></p>
                            <p class="card-text"><?=$user['email']?></p>
                            <h4 class="card-title">Informations sur le compte</h4>
                            <p class="card-text">Date d'inscription : <?=$user['user_created_date']?></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 offset-md-4 d-flex justify-content-center">
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalDelete" title="Supprimer mon compte">Supprimer mon compte</button>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal Update -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier mon compte</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="tt_update_user.php" method="post" onsubmit="return checkForm()">
                    <div class="modal-body">
                        <!-- Firstname -->
                        <div class="mb-3 required-input">
                            <label for="update-firstname" class="form-label">Prénom<sup>*</sup></label>
                            <input type="text" class="form-control" name="firstname" value="<?=$user['firstname']?>" id="update-firstname">
                            <div class="text-danger d-none error-message">Champ obligatoire</div>
                        </div>
                        <!-- Email -->
                        <div class="mb-3 required-input">
                            <label for="update-email" class="form-label">Email <sup>*</sup></label>
                            <input type="text" class="form-control" name="email" value="<?=$user['email']?>" id="email">
                            <div class="text-danger d-none error-message"></div>
                            <div class="text-danger d-none" id="email-error"></div>
                        </div>
                        <!-- Id -->
                        <input type="hidden" name="user_id" value="<?=$user['user_id']?>">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                        <input type="submit" class="btn btn-green" value="Valider">
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning ms-0 me-auto" data-bs-target="#modalUpdatePassword" data-bs-toggle="modal">Modifier mot de passe</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Update Password -->
    <div class="modal fade" id="modalUpdatePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modifier mon mot de passe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Old Password -->
                    <div class="mb-3 required-input-2">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="password" class="form-control" name="old-password" id="old-password" placeholder="password">
                                <label for="old-password">Ancien mot de passe</label>
                            </div>
                            <span class="input-group-text" onclick="changePasswordVisibility('old-password-eye','old-password-eye-slash','old-password')">
                                <span id="old-password-eye"><?php require("icons/eye.php"); ?></span>
                                <span id="old-password-eye-slash" class="d-none"><?php require("icons/eye-slash.php"); ?></span>
                            </span>
                        </div>
                        <div class="text-danger d-none error-message"></div>
                    </div>
                    <!-- New password -->
                    <div class="mb-3 required-input-2">
                        <div class="input-group">
                            <div class="form-floating">
                                <input type="password" class="form-control" name="new-password" id="new-password" placeholder="password">
                                <label for="new-password">Nouveau mot de passe</label>
                            </div>
                            <span class="input-group-text" onclick="changePasswordVisibility('new-password-eye','new-password-eye-slash','new-password')">
                                <span id="new-password-eye"><?php require("icons/eye.php"); ?></span>
                                <span id="new-password-eye-slash" class="d-none"><?php require("icons/eye-slash.php"); ?></span>
                            </span>
                        </div>
                        <div class="text-danger d-none error-message"></div>
                    </div>
                    <div class="text-danger d-none error-message" id="error-message"></div>
                    <!-- Id -->
                    <input type="hidden" name="user_id" id="user-id" value="<?=$user['user_id']?>">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalUpdate" title="Modifier mon compte">Retour</button>
                        <input type="submit" class="btn btn-green" value="Valider" onclick="checkFormPassword()">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-warning ms-0 me-auto" data-bs-target="#modalUpdate" data-bs-toggle="modal">Modifier mot profil</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Supprimer -->
    <div class="modal fade" id="modalDelete" tabindex="1" aria-labelledby="DeleteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="DeleteLabel">Supprimer mon compte</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Etes vous certain(e) de vouloir supprimer votre compte ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Retour</button>
                    <a href="tt_delete_user.php?user_id=<?=$user['user_id']?>"><button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Supprimer</button></a>
                </div>
            </div>
        </div>
    </div>

<script src="scripts/requiredInput.js"></script>
<script src="scripts/changePasswordVisibility.js"></script>
<script src="scripts/isValidEmail.js"></script>
<script src="scripts/updatePassword.js"></script>
<script>
    function checkForm() {
        const isValidEmailValue = isValidEmail();
        const requiredInputValue = requiredInput();

        if (isValidEmailValue && requiredInputValue) {
            return true;
        } else {
            return false;
        }
    }

    function checkFormPassword(){
        if(requiredInput('.required-input-2')){
            updatePassword()
        }
    }
</script>

<?php
    }
?>

