<?php
 ?>

<!--  Screen Accueil -->
<div class="setting-home">
  <div class="encard-setting-home">
    <?php require 'templates/asset/img/log-top.php'; ?>
  </div>
  <div class="welcome-box">
    <h3 class="clrd fw-b txt-c">Bienvenue sur PrintR</h3>
    <br>
    <p class="clrd txt-c">Développe en toute légerté</p>
  </div>
  <div class="dogit-box">
    <div class="dogit-left w-50">
      <h4 class="txt-c fw-b mall-15">Documentation</h4>
      <p class="txt-c">Pour consulter la documentation cliquer ici:</p>
      <div class="btn-doc mall-15 pall-15 txt-c">
        <a class="btn-print" href="#">Documentation</a>
      </div>
    </div>
    <div class="dogit-right w-50">
      <h4 class="txt-c fw-b mall-15">Lien GitHub</h4>
      <a href="https://github.com/yakapi/PrintR">
        <div class="encard-git">
          <img src="templates/asset/img/git.png" alt="lien-github">
        </div>
        <p class="lk-git txt-c">https://github.com/yakapi/PrintR</p>
      </a>
    </div>
  </div>
  <div class="last-update">
    <?php require 'last_update.php'; ?>
  </div>
</div>
