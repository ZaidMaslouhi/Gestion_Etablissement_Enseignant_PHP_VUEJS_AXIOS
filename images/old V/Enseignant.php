
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
							<td><button @click="showingeditModal = true; selectData(data);" class="btn btn-warning">Modifier</button></td>
							<td><button @click="showingdeleteModal = true; selectData(data);" class="btn btn-danger">Supprimer</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	<!-- add modal -->
		<div class="modal col-md-6" id="addmodal" v-if="showingaddModal">
				<div class="modal-head">
					<p class="p-left p-2">Ajouter Enseignant</p>
					<hr/>
					<div class="modal-body">
							<div class="col-md-12">
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
						<hr/>
							<button type="button" class="btn btn-success"  @click="showingaddModal = false; addData();">Ajouter</button>
							<button type="button" class="btn btn-danger"   @click="showingaddModal = false;">Annuler</button>
					</div>
				</div>
			</div>


	<!-- edit modal -->
		<div class="modal col-md-6" id="editmodal" v-if="showingeditModal">
			<div class="modal-head">
				<p class="p-left p-2">Modifier Enseignant</p>
				<hr/>
				<div class="modal-body">
						<div class="col-md-12">
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
					<hr/>
						<button type="button" class="btn btn-success"  @click="showingeditModal = false; updateData();">Modifier</button>
						<button type="button" class="btn btn-danger"   @click="showingeditModal = false;">Annuler</button>
				</div>
			</div>
		</div>


		<!-- delete data -->
		<div class="modal col-md-6" id="deletemodal" v-if="showingdeleteModal">
			<center>
				<div class="modal-head">
					<p class="p-left p-2">Supprimer Enseignant</p>
					<hr/>
					<div class="modal-body">
								<p>Etes-vous sûr que vous voulez supprimer ?</p>
								<h3>{{clickedData.NomEnsei}}</h3>
						<hr/>
							<button type="button" class="btn btn-danger"  @click="showingdeleteModal = false; deleteData();">Supprimer</button>
							<button type="button" class="btn btn-dark"   @click="showingdeleteModal = false;">Annuler</button>
					</div>
				</div>
			</center>
		</div>


		<?php require_once('footer.php'); ?>
