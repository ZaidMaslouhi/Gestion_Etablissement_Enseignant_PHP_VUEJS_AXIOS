
	<?php require_once('header.php'); ?>

			<table class="table table-striped table-hover">
				<thead class="thead">
					<tr>
						<th>#ID</th>
						<th>Nom</th>
						<th>Prenom</th>
						<th>Grade</th>
						<th>Type</th>
						<th>Heures Enseignement</th>
						<th>Prix/Heure</th>
						<th>Etablissement</th>
						<th>Modifier</th>
						<th>Supprimer</th>
					</tr>
				</thead>
				<tbody class="tbody-custom">
					<tr v-for="data in dataFtr">						
						<th>{{data.idEnsei}}</th>
						<td>{{data.NomEnsei}}</td>
						<td>{{data.PreNomEnsei}}</td>
						<td>{{data.Grade}}</td>
						<td>{{data.TypeEnsei}}</td>
						<td v-if="data.HeureEnsei">{{data.HeureEnsei + ' h'}}</td>
							<td v-else>-</td>
						<td>{{data.PrixHeure + ' DH'}}</td>
						<td>{{data.NomEtab}}</td>
						<td><button @click="selectData(data);" data-toggle="modal" 
									data-target="#ModModal" class="btn btn-info">
								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>Modifier
							</button></td>
						<td><button @click="selectData(data);" data-toggle="modal" 
									data-target="#SupModel" class="btn btn-danger">
									<i class="fa fa-trash" aria-hidden="true"></i>Supprimer
							</button></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- add modal -->
	<div class="modal fade" id="AjModal" tabindex="-1" role="dialog" aria-labelledby="AjModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title">Ajouter Enseignant</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<label for="newNom">Nom</label>
					<input type="text" id="newNom" class="form-control" 
						v-model="newData.NomEnsei">
					
					<label for="newPrenom">Prenom</label>
					<input type="text" id="newPrenom" class="form-control" 
						v-model="newData.PreNomEnsei">

					<label for="Grade">Grade</label>
					<select class="form-control" id="Grade" v-model="newData.Grade">
						<option selected>PA</option>
						<option>PH</option>
						<option>PES</option>
					</select>

					<label for="Type">Type</label>
					<select class="form-control" id="Type" v-model="newData.TypeEnsei">
						<option selected>Vacataire</option>
						<option>Permanent</option>
					</select>

					<label for="idEtabEnsei">Etablissement</label>
					<select class="form-control" id="idEtabEnsei" 
							v-model="newData.idEtabEnsei">
						<option v-for="etab in etabs" :value="etab.idEtab">{{etab.NomEtab}}</option>
					</select>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					<button type="button" class="btn btn-success" data-dismiss="modal" @click="addData();">Ajouter</button>
				</div>
			</div>
		</div>
	</div>

	<!-- edit modal -->
	<div class="modal fade" id="ModModal" tabindex="-1" role="dialog" aria-labelledby="ModModal" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-scrollable" role="document">
    		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title">Modifier Enseignant</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
      			<div class="modal-body">
					<label for="id">Id</label>
					<input type="text" id="id" class="form-control" 
						v-model="clickedData.idEnsei" readonly>

					<label for="Nom">Nom</label>
					<input type="text" id="Nom" class="form-control" 
						v-model="clickedData.NomEnsei">
					
					<label for="Prenom">Prenom</label>
					<input type="text" id="Prenom" class="form-control" 
						v-model="clickedData.PreNomEnsei">

					<label for="Grade">Grade</label>
					<select class="form-control" id="Grade" v-model="clickedData.Grade">
						<option selected>PA</option>
						<option>PH</option>
						<option>PES</option>
					</select>

					<label for="Type">Type</label>
					<select class="form-control" id="Type" v-model="clickedData.TypeEnsei">
						<option selected>Vacataire</option>
						<option>Permanent</option>
					</select>

					<label for="idEtabEnsei">Etablissement</label>
					<select class="form-control" id="idEtabEnsei" 
							v-model="clickedData.idEtabEnsei">
						<option v-for="etab in etabs" :value="etab.idEtab">{{etab.NomEtab}}</option>
					</select>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateData();">Modifier</button>
				</div>
			</div>
		</div>
	</div>

	<!-- delete data -->
	<div class="modal fade" id="SupModel" tabindex="-1" role="dialog" aria-labelledby="SupModel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalCenterTitle">Supprimer Enseignant</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Etes-vous sûr que vous voulez supprimer ?</p>
				<h3>{{clickedData.NomEnsei}}</h3>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" @click="deleteData();">Supprimer</button>
			</div>
		</div>
	</div>
</div>


		<?php require_once('footer.php'); ?>
