<?php 
/**
 * Template Name: Post adding form
 */

get_header(); ?>


<!-- Save as a new unpublished post -->
<?php

if (isset($_POST['title']) && $_POST['description']) {

  $title = $_POST['title'];
  $description = $_POST['description'];

  global $user_ID;

  $form_post = array(
    'post_title' => $title,
    'post_content' => $description,
    'post_date' => date('Y-m-d H:i:s'),
    'post_author' => $user_ID,
    'post_type' => 'post',
    'post_category' => array(0)
  );

  wp_insert_post($form_post);
}

?>


<!-- Form -->
<div class="form-container">
  <?php if (isset($_POST['submit'])) {
    echo '<p class="success">Post has been sent!</p>';
  } ?>
  <p class="error"></p>
  <form action="" method="post" name="form-post" class="form-post">
    <input name="title" type="text" placeholder="Add title" />
    <textarea placeholder="Add description" rows="4" name="description"></textarea>
    <input name="submit" type="submit" value="Send" class="submit" />
  </form>
</div>



<!-- Form validation -->
<script>
  let formSubmit = document.forms["form-post"];
  let formTitle = document.forms["form-post"]["title"];
  let formDescription = document.forms["form-post"]["description"];
  let formError = document.querySelector(".error");

  formSubmit.addEventListener('submit', function(e) {
    if (formTitle.value === "") {
      e.preventDefault();
      formError.textContent = "Please enter title!";
      document.myform.title.focus();
      return false;
    }
    if (formDescription.value === "") {
      e.preventDefault();
      formError.textContent = "Please enter description!";
      document.myform.description.focus();
      return false;
    }
    return true;
  });


  //  Prevent form submission
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>


<?php
get_footer();
