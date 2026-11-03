
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>LifeCare Multi-Speciality Clinic</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
          rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

	 <!-- Font Awesome -->
	  <link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/My-Demo-Project/LifeCare%20Clinic%20Website/CSS/header_CSS.css">

</head>

<body>

<!-- Header Start -->
<header class="main-header">

    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <!-- Clinic Logo -->
            <a class="navbar-brand clinic-logo" href="index.php">
                <img src="/My-Demo-Project/LifeCare%20Clinic%20Website/images/logo.png"
                     alt="LifeCare Multi-Speciality Clinic Logo"
                     class="clinic-logo-img">
            </a>

            <!-- Mobile Menu Button -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#clinicNavbar"
                    aria-controls="clinicNavbar"
                    aria-expanded="false"
                    aria-label="Toggle navigation">

                <span class="navbar-toggler-icon"></span>

            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="clinicNavbar">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">Dashboard</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="doctors.php">Our Doctors</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="appointments.php">Appointments</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>


                   <!-- Admin Login -->
                    <li class="nav-item admin-nav-item">
                        <a class="admin-login" href="admin/login.php">
                            <i class="fa-solid fa-user-shield"></i>
                            Admin
                        </a>
                    </li>

                    <!-- Book Appointment Button -->
                    <li class="nav-item appointment-nav-item">
                        <a class="btn-appointment" href="appointments.php">
                            Book Appointment
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </nav>

</header>
<!-- Header End -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
