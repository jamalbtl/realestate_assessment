<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Listing Page</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        .navbar-brand img {
            max-width: 120px;
        }

        .property-card {
            margin-bottom: 30px;
        }

        .property-slider .carousel-indicators {
            bottom: -30px;
        }
        
        .property-slider img {
            height: 200px;
            object-fit: cover;
        }
    </style>
</head>
<body>

    <!-- Navbar Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{asset('assets/images/logo.jpg')}}" alt="Logo">
            </a>

            <!-- Toggle button for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Links -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Listings</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('login')}}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Carousel Slider Section -->
    <div id="mainCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('assets/images/slider/slider-one.jpg')}}" class="d-block w-100" alt="Slide 1">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/slider/slider-two.jpeg')}}" class="d-block w-100" alt="Slide 2">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/images/slider/slider-three.jpg')}}" class="d-block w-100" alt="Slide 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Property Listing Section -->
    <div class="container mt-5">
        <div class="row">
            <!-- Property Card 1 -->
            @foreach ($properties as $property)
                @php
                    $is_active=1;
                @endphp
            
            <div class="col-md-4">
                <div class="card property-card">
                    <!-- Property Card Image Slider -->
                    <div id="propertySlider{{$property->id}}" class="carousel slide property-slider" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($property->images as $image)
                            <div class="carousel-item {{($is_active)?'active':''}}">
                                <img src="{{asset($image->img_path)}}" class="d-block w-100" alt="Property {{$property->id}} Image {{$property->id}}">
                            </div>
                            @php
                               $is_active=0; 
                            @endphp
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#propertySlider{{$property->id}}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#propertySlider{{$property->id}}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!-- Property Info -->
                    <div class="card-body">
                        <h5 class="card-title">{{$property->title}}</h5>
                        <p class="card-text">AED {{$property->price}} - {{$property->location}}</p>
                        <hr>
                        <p>{{$property->description}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
