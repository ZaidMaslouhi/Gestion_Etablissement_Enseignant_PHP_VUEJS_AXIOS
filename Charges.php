
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
					<h5 class="modal-title" id="title">Ajouter Charge</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
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
					<h5 class="modal-title" id="title">Modifier Charges</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
      			<div class="modal-body">
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
					<h5 class="modal-title" id="exampleModalCenterTitle">Supprimer Charge</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
      			</div>
				<div class="modal-body">
					<p>Etes-vous sûr que vous voulez supprimer ?</p>
					<h3>{{clickedData.idCharges}}</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal" @click="deleteData();">Supprimer</button>
				</div>
 		   </div>
 		 </div>
	</div>


	<?php require_once('footer.php'); ?>
