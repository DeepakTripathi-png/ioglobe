<style>
    .navbar-toggler {
    padding: 0.20rem 0.20rem;
    font-size: 1.10rem;
    line-height: 1;
    background-color: transparent;
    border: 1px solid transparent;
    border-radius: 0.25rem;
   }

.navbar-nav a.active {
    color: red !important;   
    font-weight: bold !important;
}


.active {
    color: red;
}


.navbar-brand {
    padding-top: 1.3125rem;
    padding-bottom: .3125rem;
    margin-right: 1rem;
    font-size: 1.25rem;
    text-decoration: none;
    white-space: nowrap;
}

@media (max-width: 390px) {
    .navbar-brand {
        flex-wrap: wrap; /* Allow wrapping for smaller screens */
        text-align: center; /* Center align for better aesthetics */
    }

    .navbar-brand img {
        max-height: 40px; /* Reduce image height for small screens */
        margin-bottom: 5px; /* Add spacing if wrapped */
    }

    .navbar-brand span {
        font-size: 0.9rem; /* Adjust font size for readability */
    }
}

.navbar-brand {
    display: flex;
    align-items: center;
    text-decoration: none;
    white-space: nowrap;
 }

.navbar-brand img {
    max-height: 48px;
    height: auto;
    margin-right: 10px;
}

.navbar-brand span {
    font-size: 1rem; /* Adjust font size */
    color: #333; /* Ensure text is visible */
}
</style>



{{-- <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{url('/')}}">
            <img src="{{ asset('front/images/ioglobe_front_logo.png') }}" alt="FireAlarm Logo" style="max-height: 48px; margin-right: 10px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>       
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Testimonials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav> --}}



<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        {{-- <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('front/images/ioglobe_front_logo.png') }}" alt="FireAlarm Logo" style="max-height: 48px; margin-right: 10px;">
        </a> --}}

        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}" style="white-space: nowrap;">
            <img src="{{ asset('front/images/ioglobe_front_logo.png') }}" 
                 alt="FireAlarm Logo" 
                 style="max-height: 48px; margin-right: 10px;">
            <span style="font-size: 1rem; font-weight: bold; color: #333;"></span>
        </a>
        

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#features">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#services">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#testimonials">Testimonials</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>