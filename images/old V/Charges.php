
	<?php require_once('header.php'); ?>

		<table class="table table-striped table-hover">
			<thead class="thead">
				<tr>
					<th>#ID</th>
					<th>Semestre</th>
					<th>Filiere</th>
					<th>Niveau</th>
					<th>Module</th>
					<th>Matiere</th>
					<th>Type</th>
					<th>Vol.Horaire</th>
					<th>Departement</th>
					<th>Enseignant</th>
					<th>Modifier</th>
					<th>Supprimer</th>
				</tr>
			</thead>
			<tbody class="tbody-custom">
				<tr v-for="data in dataFtr">
					<th>{{data.idCharges}}</th>
					<td>{{data.Semestre}}</td>
					<td>{{data.Filiere}}</td>
					<td>{{data.Niveau}}</td>
					<td>{{data.Module}}</td>
					<td>{{data.Matiere}}</td>
					<td>{{data.TypeEtude}}</td>
					<td>{{data.VolumeHoraire}}</td>
					<td>{{data.DepartementAttacher}}</td>
					<td>{{data.NomEnsei}}</td>
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
				<p class="p-left p-2">Ajouter Charge</p>
				<hr/>
				<div class="modal-body">
						<div class="col-md-12">
							<label for="Semestre">Semestre</label>
							<input type="text" id="Semestre" class="form-control" v-model="newData.Semestre">
							
							<label for="Filiere">Filiere</label>
							<input type="text" id="Filiere" class="form-control" v-model="newData.Filiere">
							
							<label for="Niveau">Niveau</label>
							<input type="text" id="Niveau" class="form-control" v-model="newData.Niveau">
							
							<label for="Module">Module</label>
							<input type="text" id="Module" class="form-control" v-model="newData.Module">
							
							<label for="Matiere">Matiere</label>
							<input type="text" id="Matiere" class="form-control" v-model="newData.Matiere">
							
							<label for="type">Type</label>
							<select class="form-control" id="type" v-model="newData.TypeEtude">
									<option selected>Cour</option>
									<option>TP</option>
									<option>TD</option>
							</select>

							<label for="VolumeHoraire">VolumeHoraire</label>
							<input type="text" id="VolumeHoraire" class="form-control" v-model="newData.VolumeHoraire">
							
							<label for="Departement">Departement Attacher</label>
							<input type="text" id="Departement" class="form-control" v-model="newData.DepartementAttacher">
							
							<label for="Enseignant">Enseignant</label>
							<select class="form-control" id="Enseignant" 
								v-model="newData.idEnseiCharge">
								<option v-for="ens in enss" :value="ens.idEnsei">
									{{ens.NomEnsei}}
								</option>
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
			<p class="p-left p-2">Modifier Charges</p>
			<hr/>
			<div class="modal-body">
				<div class="col-md-12">

					<label for="id">ID</label>
					<input type="text" id="id" class="form-control" v-model="clickedData.idCharges" readonly>
					
					<label for="Semestre">Semestre</label>
					<input type="text" id="Semestre" class="form-control" v-model="clickedData.Semestre">
					
					<label for="Filiere">Filiere</label>
					<input type="text" id="Filiere" class="form-control" v-model="clickedData.Filiere">
					
					<label for="Niveau">Niveau</label>
					<input type="text" id="Niveau" class="form-control" v-model="clickedData.Niveau">
					
					<label for="Module">Module</label>
					<input type="text" id="Module" class="form-control" v-model="clickedData.Module">
					
					<label for="Matiere">Matiere</label>
					<input type="text" id="Matiere" class="form-control" v-model="clickedData.Matiere">
					
					<label for="type">Type</label>
					<select class="form-control" id="type" v-model="clickedData.TypeEtude">
							<option selected>Cour</option>
							<option>TP</option>
							<option>TD</option>
					</select>

					<label for="VolumeHoraire">VolumeHoraire</label>
					<input type="text" id="VolumeHoraire" class="form-control" v-model="clickedData.VolumeHoraire">
					
					<label for="Departement">Departement Attacher</label>
					<input type="text" id="Departement" class="form-control" v-model="clickedData.DepartementAttacher">
						
					<label for="Enseignant">Enseignant</label>
					<select class="form-control" id="Enseignant" 
						v-model="clickedData.idEnseiCharge">
						<option v-for="ens in enss" :value="ens.idEnsei">
							{{ens.NomEnsei}}
						</option>
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
				<p class="p-left p-2">Supprimer Charge</p>
				<hr/>
				<div class="modal-body">
							<p>Etes-vous sûr que vous voulez supprimer ?</p>
							<h3>{{clickedData.idCharges}}</h3>
					<hr/>
						<button type="button" class="btn btn-danger"  @click="showingdeleteModal = false; deleteData();">Supprimer</button>
						<button type="button" class="btn btn-dark"   @click="showingdeleteModal = false;">Annuler</button>
				</div>
			</div>
		</center>
	</div>

	<?php require_once('footer.php'); ?>
