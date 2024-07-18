<?php
session_start();
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logging Out...</title>
<style>
body {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  margin: 0;
  font-family: Arial, sans-serif;
  background: #f0f0f0;
}

.spinner {
  display: inline-block;
  width: 80px;
  height: 80px;
  border: 4px solid rgba(0, 0, 0, 0.1);
  border-radius: 50%;
  border-top-color: #3498db;
  animation: spin 1s ease-in-out infinite;
}

@keyframes spin {
  to {
    transform: rotate(360deg);
  }
}

.message {
  margin-top: 20px;
  font-size: 1.2em;
  color: #333;
}
</style>
</head>
<body>
<div class="spinner"></div>
<div class="message">You have logged out and will be redirected shortly...</div>

<script>
// Redirect after 3 seconds
setTimeout(function() {
  window.location.href = 'login.php';
}, 3000);
</script>

</body>
</html>
