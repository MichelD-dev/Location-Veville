  <!------------------------------------- MODAL SIGNUP ---------------------------------->

  <div class="modal fade" id="signup">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content p-3">
              <div class="modal-header text-center border-0">
                  <h5 class="modal-title w-100 pb-3">S'inscrire</h5>
              </div>
              <div class="modal-body py-0">
                  <form method="POST">
                      <div class="mb-3">
                          <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo">
                      </div>
                      <div class="mb-3">
                          <input type="password" class="form-control" name="mdp" placeholder="Votre mot de passe">
                      </div>
                      <div class="mb-3">
                          <input type="text" class="form-control" name="nom" placeholder="Votre nom">
                      </div>
                      <div class="mb-3">
                          <input type="text" class="form-control" name="prenom" placeholder="Votre prénom">
                      </div>
                      <div class="mb-3">
                          <input type="mail" class="form-control" name="email" placeholder="Votre email">
                      </div>
                      <div class="mb-3">
                          <select id="civilite" name="civilite" class="form-select text-muted">
                              <option value=1>Homme</option>
                              <option value=2>Femme</option>
                          </select>
                      </div>
                      <div class="modal-footer border-0 pt-2">
                          <input type="submit" class="btn btn-primary col-8 mx-auto" name="sign_up">
                      </div>
                  </form>
              </div>

          </div>
      </div>
  </div>