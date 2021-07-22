<?php

require __DIR__ . '/load.php';


$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';


function login_header($title = "Log In", $message = "")
{
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>

    <link rel="stylesheet" href="/admin/includes/css/tailwind/tailwind.min.css">
    <link rel="stylesheet" href="/admin/includes/css/common.min.css">


  </head>

  <body class="login no-js">
    <script type="text/javascript">
      document.body.className = document.body.className.replace('no-js', 'js');
    </script>

    <div id="login">
      <?php
      if (!empty($message)) {
        echo $message . "\n";
      }

      ?>
    <?php
  }

  function login_footer()
  {
    ?>
  </body>

  </html>
  <?php
  }

  switch ($action) {
    case 'logout':
      logout();
      break;
    case 'login':
    default:
      $error = false;
      $title = "Log In";

      $rememberme = !empty($_POST['rememberme']);
      if (!empty($_POST['log'])) {
        $user_name = filter_input(INPUT_POST, 'log');
        $user      = get_user_by('login', $user_name);

        if (!$user && strpos($user_name, '@')) {
          $user = get_user_by('email', $user_name);
        }

        if (isset($_REQUEST['redirect_to'])) {
          $redirect_to = $_REQUEST['redirect_to'];
          // Redirect to HTTPS if user wants SSL.
        } else {
          $redirect_to = "/admin/";
        }

        $user = signon(array());
        if ($user instanceof Error) {
          $error = '<div class="bg-yellow-50 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
          <p>' . $user->getMessage() . '</p></div>';
        } else {
          session_start();
          $_SESSION['user'] = $user;
          header('Location: /admin/');
          exit;
        }
      }
      login_header($title);
  ?>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8 p-4 bg-white">
        <div>
          <h1 class="mt-6 text-center text-3xl text-gray-900">
            jonick Shop
          </h1>
          <h2 class="mt-2 text-center text-2xl text-gray-900">
            <?php echo $title; ?>
          </h2>
        </div>
        <?php echo $error ? $error : false ?>
        <form class="mt-8 space-y-6" name="loginform" id="loginform" action="/login.php" method="post">
          <input type="hidden" name="remember" value="true">
          <div class="rounded-md shadow-sm -space-y-px">
            <div class="mb-2">
              <label for="user_login" class="p-1 block text-center">Username</label>
              <input id="user_login" name="log" type="text" value="" size="20" autocapitalize="off" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" placeholder="Username">
            </div>
            <div>
              <label for="user_pass" class="p-1 block text-center">Password</label>
              <input type="password" name="pwd" id="user_pass" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-green-500 focus:border-green-500 focus:z-10 sm:text-sm" value="" size="20" placeholder="Password" />
            </div>
          </div>

          <div class="flex-none md:flex items-center justify-between">
            <div class="flex items-center">
              <input id="remember-me" name="rememberme" type="checkbox" class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
              <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                Remember me
              </label>
            </div>

            <div class="text-sm mt-2 md:mt-0">
              <a href="/login.php?action=lostPassword" class="font-medium text-green-600 hover:text-green-500">
                Forgot your password?
              </a>
            </div>
          </div>

          <div>
            <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
              Sign in
            </button>
          </div>
        </form>
      </div>
    </div>
<?php
      login_footer();
      break;
  }
