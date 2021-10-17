<?php
  get_header();
?>
<div class="error-page" >
  <div class="container">
    <div class="row">
      <div class="column large-12">
        <h1>404</h1>
        <p>OOOOPS!!! La page que vous cherchez est indisponible </p>
        <div class="blocButton">
          <a href="<?= home_url(); ?>" class="button">Retour à l'accueil</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
  get_footer();
?>