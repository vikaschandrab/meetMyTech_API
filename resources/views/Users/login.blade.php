<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="MeetMyTech">
	<meta name="keywords" content="meetmytect, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{asset('dashboard_css/img/icons/icon-48x48.png')}}" />

	{{-- <link rel="canonical" href="https://demo-basic.adminkit.io/pages-sign-in.html" /> --}}

	<title>Sign In | MeetMyTech</title>

	<link href="{{asset('dashboard_css/css/app.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Welcome back!</h1>
							<p class="lead">
								Sign in to your account to continue
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									
									<!-- Display Flash Messages -->
									@if(session('message'))
										<div class="alert alert-{{ session('message_type', 'info') }} alert-dismissible fade show" role="alert">
											{{ session('message') }}
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									@endif

									<!-- Display Validation Errors -->
									@if($errors->any())
										<div class="alert alert-danger alert-dismissible fade show" role="alert">
											<ul class="mb-0">
												@foreach($errors->all() as $error)
													<li>{{ $error }}</li>
												@endforeach
											</ul>
											<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
										</div>
									@endif

									<form  action="{{ route('login.submit') }}" method="POST" >
                                        @csrf
										<div class="mb-3">
											<label class="form-label">Email</label>
											<input class="form-control form-control-lg @error('email') is-invalid @enderror" 
												type="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" required />
											@error('email')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
										<div class="mb-3">
											<label class="form-label">Password</label>
											<input class="form-control form-control-lg @error('password') is-invalid @enderror" 
												type="password" name="password" placeholder="Enter your password" required />
											@error('password')
												<div class="invalid-feedback">{{ $message }}</div>
											@enderror
										</div>
                                        <div class="mb-3">
                                            <a href="#" class="form-check-label text-small text-decoration-none">
                                            Forgot Password?
                                            </a>
										</div>
										<div class="d-grid gap-2 mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                                        </div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Bootstrap JS for alert functionality -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="{{asset('dashboard_css/js/app.js')}}"></script>

</body>

</html>
