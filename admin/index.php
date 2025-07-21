<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$uname = $_POST['username'];
	$password = md5($_POST['password']);
	$sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
	$query = $dbh->prepare($sql);
	$query->bindParam(':uname', $uname, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	if ($query->rowCount() > 0) {
		$_SESSION['alogin'] = $_POST['username'];
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	} else {

		echo "<script>alert('Invalid Details');</script>";
	}
}

?>
<!DOCTYPE HTML>
<html>

<head>
    <title>Traveler | Admin Sign in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('../assets/images/banner-img4.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            transition: background-image 0.8s ease-in-out;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .btn-primary {
            background-color: #86b716;
            border-color: #86b716;
        }

        .btn-primary:hover {
            background-color: #74a610;
            border-color: #74a610;
        }

        .text-primary {
            color: #86b716 !important;
        }

        .logo-container {
            position: absolute;
            top: 20px; /* Distance from the top */
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
        }
    </style>
</head>

<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <!-- Logo Container - Positioned at the top center of the page -->
        <div class="logo-container text-center">
            <h1 class="site-title">
                <a href="index.php">
                    <!-- Inline CSS to control logo size -->
                    <img src="../assets/images/site-logo1.png" alt="Logo" style="width: 400px; height: auto; margin:20px">
                </a>
            </h1>
        </div>

        <!-- Form Container -->
        <div class="glass-card p-4 w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <h4 class="text-white">Admin Sign In</h4>
            </div>
            <form method="post">
                <div class="form-group mb-3">
                    <label for="username" class="form-label text-white">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="form-group mb-4">
                    <label for="password" class="form-label text-white">Password</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                </div>
            </form>
            <div class="text-center mt-3">
                <a href="../index.php" class="text-decoration-none text-light">Back to home</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const images = [
            '../assets/images/banner-img1.jpg',
            '../assets/images/banner-img2.jpg',
            '../assets/images/banner-img3.jpg',
            '../assets/images/banner-img4.jpg',
            '../assets/images/banner-img5.jpg'
        ];

        let currentIndex = 0;

        function changeBackground() {
            currentIndex = (currentIndex + 1) % images.length;
            document.body.style.backgroundImage = `url('${images[currentIndex]}')`;
        }

        setInterval(changeBackground, 5000);
    </script>
</body>

</html>
