<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Gestion des heures supplémentaires</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
	<script src="js/font-awesome.js"></script>
</head>
<body>
	
	<div id="root">
		<nav class="navbar navbar-expand-lg navbar-dark">
			<a class="navbar-brand" href="#">
				<h3 style="font-weight: bold">Appy</h3>
			</a>
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" href="Etablissement.php">Etablissements <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="Enseignant.php">Enseignants <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="Charges.php">Les charges des Enseignants<span class="sr-only">(current)</span></a>
				</li>
			</ul>
		</nav>

		<div class="container p-4">
			<div class="row blockEtab">
				<div class="alert alert-danger col-md-12" id="alertMessage" role="alert" 
					v-if="errorMessage"  @click="errorMessage = ''">
					{{ errorMessage }}
				</div>

				<div class="alert alert-success col-md-12" id="alertMessage" role="alert" 
					v-if="successMessage" @click="successMessage = ''">
					{{ successMessage }}
				</div>

				<div class="mb-4 d-flex w-100">
					<button class="btn btn-success mr-auto" 
						data-toggle="modal" data-target="#AjModal">
						<!-- <i class="fa fa-plus-square mr-2" aria-hidden="true"></i> -->
						Ajouter
					</button>

					<label for="search" class="lblSearch align-self-end text-dark mr-2 font-weight-normal">Rechercher: </label>
					<input type="text" id="search" class="form-control w-25" v-model="search" v-on:keyup="filterData()">

				</div>
