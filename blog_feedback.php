<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Envía tu feedback</title>
	<link rel="stylesheet" href="css/all.min_blog.css"> <!-- https://fontawesome.com/ -->
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap" rel="stylesheet"> <!-- https://fonts.google.com/ -->
    <link href="css/bootstrap.min_blog.css" rel="stylesheet">
    <link href="css/template_blog.css" rel="stylesheet">
	<link rel="icon" href="favicon.ico" type="image/x-icon">

</head>
<body>
	<header class="tm-header" id="tm-header">
        <div class="tm-header-wrapper">
            <button class="navbar-toggler" type="button" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Logo doginn esquina superior izda. -->
            <div class="tm-site-header">
                <div class="mb-3 mx-auto tm-site-logo"><img src="img/blog/logo_sf.png" width="150" height="150"></i></div><br>           
                <h1 class="text-center">SOBRE NOSOTROS</h1>
            </div>
            <nav class="tm-nav" id="tm-nav">            
                <ul>
                    <li class="tm-nav-item active"><a href="blog_index.php" class="tm-nav-link">
                        <i class="fas fa-home"></i>
                        BLOG
                    </a></li>

                    <li class="tm-nav-item"><a href="blog_trabaja_aqui.php" class="tm-nav-link">
                        <i class="fas fa-users"></i>
                        TRABAJA AQUÍ
                    </a></li>
                    <li class="tm-nav-item"><a href="blog_feedback.php" class="tm-nav-link">
                        <i class="far fa-comments"></i>
                        RESEÑAS
                    </a></li>
                </ul>
            </nav>
            <div class="tm-mb-65">
            <a rel="nofollow" href="https://fb.com/templatemo" class="tm-social-link">
                    <i class="fab fa-facebook tm-social-icon"></i>
                </a>
                <a href="https://twitter.com" class="tm-social-link">
                    <i class="fab fa-twitter tm-social-icon"></i>
                </a>
                <a href="https://instagram.com" class="tm-social-link">
                    <i class="fab fa-instagram tm-social-icon"></i>
                </a>
               
            </div>
            <p class="tm-mb-80 pr-5 text-white">
            Explora nuestra sección para conectarte mejor con nosotros. Descubre nuestro 
            blog y disfruta de nuestros artículos. Únete a nuestro equipo y comparte tus 
            comentarios para ayudarnos a crecer.
            </p>
        </div>
    </header>
    <div class="container-fluid">
        <main class="tm-main">
            <!-- Formulario -->
            <div class="row tm-row tm-mb-120">
                <div class="col-12">
                <img src="img/blog/feedback1.webp" alt="Image" class="img-fluid" width="700" >
                <h2 class="tm-color-primary tm-post-title tm-mb-60" style="text-align: center; font-size: 40px;">Tu opinión es importante</h2>
                    <p>
                        Aquí tienes la oportunidad de compartir tu feedback con nosotros 
                        para que podamos considerar tu opinión. Por favor, completa el siguiente 
                        formulario para enviarnos tus comentarios.
                    </p>
                    <br>
                </div>
                
                <div class="col-lg-7 tm-contact-left">
                    <form method="POST" action="" class="mb-5 ml-auto mr-0 tm-contact-form">                        
                        <div class="form-group row mb-4">
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="name" id="name" type="text" placeholder="Nombre y Apellidos" style="width: 500px;" required>                            
                            </div>
                        </div>

                        <div class="form-group row mb-4">
                            <div class="col-sm-9">
                                <input class="form-control mr-0 ml-auto" name="email" id="email" type="email" placeholder="Correo electrónico" required>
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-sm-9">
                                <textarea class="form-control mr-0 ml-auto" name="message" id="message" rows="8" style="resize: none" placeholder="Déjanos tu opinión" required></textarea>                                
                            </div>
                        </div>

                        <div class="form-group row text-right">
                            <div class="col-12">
                                <button class="tm-btn tm-btn-primary tm-btn-small">Enviar</button>                        
                            </div>                            
                        </div>                                
                    </form>
                </div>
                <div class="col-lg-5 tm-contact-right">
                    <p class="mb-5 tm-line-height-short">
                    En DOGiNN, el feedback es fundamental porque promueve una cultura de 
                    mejora continua y desarrollo tanto a nivel individual como organizacional. 
                    Al proporcionar y recibir retroalimentación regularmente, los empleados 
                    tienen la oportunidad de entender sus fortalezas y áreas de mejora, lo que 
                    les permite crecer profesionalmente y contribuir de manera más efectiva al equipo.    
                    </p>
                </div>
            </div>      
            <footer class="row tm-row">
                <hr class="col-12">
                <div class="col-md-6 col-12 tm-color-gray">
                <a href="index_main.php">Doginn & Company</a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="mailto:doginnenterprise@gmail.com">doginnenterprise@gmail.com</a>
                
                </div>
                <div class="col-md-6 col-12 tm-color-gray tm-copyright">
                <a>© Todos los derechos reservados 2024</a>
                </div>
            </footer>
        </main>
    </div>
    <script src="js/jquery.min.js"></script>
    <!-- <script src="js/templatemo-script.js"></script>-->
</body>
</html>
