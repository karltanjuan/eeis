<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CEIS</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }


            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 50px;
                margin-bottom:0;
            }

            .title > p {
              color: #333 !important;
              font-weight: bold;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: -30px;
            }

            .our-team {
			  padding: 30px;
			  margin-bottom: 30px;
			  background-color: #eee;
			  text-align: center;
			  overflow: hidden;
			  position: relative;
			  width: 100%;
			  height: 130px;
			  border-right: 2px solid #333;
			}

			.our-team .picture {
			  display: inline-block;
			  height: 130px;
			  width: 130px;
			  z-index: 1;
			  position: relative;
			}

			.our-team .picture::before {
			  content: "";
			  width: 100%;
			  height: 0;
			  border-radius: 50%;
			  background-color: #1369ce;
			  position: absolute;
			  bottom: 135%;
			  right: 0;
			  left: 0;
			  opacity: 0.9;
			  transform: scale(3);
			  transition: all 0.3s linear 0s;
			}

			.our-team:hover .picture::before {
			  height: 100%;
			}

			.our-team .picture::after {
			  content: "";
			  width: 100%;
			  height: 100%;
			  border-radius: 50%;
			  background-color: #1369ce;
			  position: absolute;
			  top: 0;
			  left: 0;
			  z-index: -1;
			}

			.our-team .picture img {
			  width: 125px;
			  height: 125px;
			  border-radius: 50%;
			  transform: scale(1);
			  transition: all 0.9s ease 0s;
			}

			.our-team:hover .picture img {
			  box-shadow: 0 0 0 14px #f7f5ec;
			  transform: scale(0.7);
			}

			.our-team .title {
			  display: block;
			  font-size: 15px;
			  color: #4e5052;
			  text-transform: capitalize;
			}

			.our-team .social {
			  width: 100%;
			  padding: 0;
			  margin: 0;
			  background-color: #1369ce;
			  position: absolute;
			  bottom: -100px;
			  left: 0;
			  transition: all 0.5s ease 0s;
			}

			.our-team:hover .social {
			  bottom: 0;
			}

			.our-team .social li {
			  display: inline-block;
			}

			.our-team .social li a {
			  display: block;
			  padding: 10px;
			  font-size: 17px;
			  color: white;
			  transition: all 0.3s ease 0s;
			  text-decoration: none;
			}

			.our-team .social li a:hover {
			  color: #1369ce;
			  background-color: #f7f5ec;
			}

			div {
				display: inline-block;
			}

			.team-content {
				margin-top: -20px;
			}

        </style>

        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        @if (auth()->user()->is_admin == 1)
                            <a href="{{ url('admin') }}">Home</a>
                        @elseif (auth()->user()->is_admin == 0)
                          <a href="{{ url('user') }}">Home</a>
                        @endif
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        <a href="/about-us">About Us</a>

                        @if (Route::has('register'))
                            <!-- <a href="{{ route('register') }}">Register</a> -->
                        @endif
                    @endauth
                </div>
            @endif
            <div class="content">
                <div class="title m-b-md">
                    <p>ABOUT US</p>
                </div>
				<div class="row">
				    <div class="col-md-6">
				      <div class="our-team">
				        <div class="picture">
				          <img class="img-fluid" src="{{url('img/gian.jpg')}}">
				        </div>
				        <div class="team-content">
				          <h3 class="name">Gian Carlo, Raagas</h3>
				          <h4 class="title">Web Developer</h4>
				        </div>
				      </div>
				    </div>
				    <div class="col-md-6">
				      <div class="our-team">
				        <div class="picture">
				          <img class="img-fluid" src="{{url('img/von.jpg')}}">
				        </div>
				        <div class="team-content">
				          <h3 class="name">Michael Von Angelo Perez</h3>
				          <h4 class="title">Database Administrator</h4>
				        </div>
				      </div>
				    </div>
				    <div class="col-md-6">
				      <div class="our-team">
				        <div class="picture">
				          <img class="img-fluid" src="{{url('img/jay.jpg')}}">
				        </div>
				        <div class="team-content">
				          <h3 class="name">Jayvee Loyogoy</h3>
				          <h4 class="title">Web Developer</h4>
				        </div>
				      </div>
				    </div>
				    <div class="`">
				      <div class="our-team">
				        <div class="picture">
				          <img class="img-fluid" src="{{url('img/maria.jpg')}}">
				        </div>
				        <div class="team-content">
				          <h3 class="name">Maria Luisa Guila</h3>
				          <h4 class="title">Web Designer</h4>
				        </div>
				      </div>
				    </div>
				     <div class="col-md-6">
				      <div class="our-team">
				        <div class="picture">
				          <img class="img-fluid" src="{{url('img/cess.jpg')}}">
				        </div>
				        <div class="team-content">
				          <h3 class="name">Princess Mae Aganus</h3>
				          <h4 class="title">Web Designer</h4>
				        </div>
				      </div>
				    </div>
				</div>
                <h4>CEIS &copy; Copyright {{ date('Y') }}</h4>
            </div>
        </div>
    </body>
</html>
