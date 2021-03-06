<?php
session_start();

// Flash message helper
// EXAMPLE - flash('register_success', 'You are now registered');
// DISPLAY IN VIEW - echo flash('register_success');
function flash($name = '', $message = '', $class = 'alert-success')
{
  if (!empty($name)) {
    if (!empty($message) && empty($_SESSION[$name])) {
      if (!empty($_SESSION[$name])) {
        unset($_SESSION[$name]);
      }

      if (!empty($_SESSION[$name . '_class'])) {
        unset($_SESSION[$name . '_class']);
      }

      $_SESSION[$name] = $message;
      $_SESSION[$name . '_class'] = $class;
    } elseif (empty($message) && !empty($_SESSION[$name])) {
      $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
      // echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
      echo '
      <div class="alert ' .$class .' alert-dismissible text-center fade show" role="alert">
          <strong></strong> ' . $_SESSION[$name] . '
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      ';

      unset($_SESSION[$name]);
      unset($_SESSION[$name . '_class']);
    }
  }
}

function isLoggedIn()
{
  return isset($_SESSION['user']) ? true : false;
}