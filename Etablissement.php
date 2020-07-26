
	<?php require_once('header.php'); ?>


	
			<table class="table table-striped table-hover">
				<thead class="thead">
					<tr>
						<th>#ID</th>
						<th>Nom</th>
						<th>EMAIL</th>
						<th>TEL</th>
						<th>ADRESS</th>
						<th>VILLE</th>
						<th>Modifier</th>
						<th>Supprimer</th>
					</tr>
				</thead>
				<tbody class="tbody-custom">
					<tr v-for="data in dataFtr">
						<th>{{data.idEtab}}</th>
						<td>{{data.NomEtab}}</td>
						<td>{{data.email}}</td>
						<td>{{data.tel}}</td>
						<td>{{data.adress}}</td>
						<td>{{data.ville}}</td>
						<td><button @click="selectData(data);" data-toggle="modal" 
							data-target="#ModModal" class="btn btn-info">
							Modifier
						</button></td>
						<td><button @click="selectData(data);" data-toggle="modal" 
							data-target="#SupModel" class="btn btn-danger">
							Supprimer
						</button></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<!-- Ajouter modal -->
	<div class="modal fade" id="AjModal" tabindex="-1" role="dialog" aria-labelledby="AjModal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title">Ajouter Etablissement</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<label for="nom">Nom</label>
					<input type="text" id="nom" class="form-control" 
						v-model="newData.NomEtab">

					<label for="EMAIL">EMAIL</label>
					<input type="email" id="EMAIL" class="form-control" 
						v-model="newData.email">

					<label for="TEL">TEL</label>
					<input type="tel" id="TEL" class="form-control" 
						v-model="newData.tel">

					<label for="ADRESS">ADRESS</label>
					<input type="text" id="ADRESS" class="form-control" 
						v-model="newData.adress">

					<label for="VILLE">VILLE</label>
					<input type="text" id="VILLE" class="form-control" 
						v-model="newData.ville">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
					<button type="button" class="btn btn-success" data-dismiss="modal"
							@click="addData();">Ajouter</button>
				</div>
			</div>
		</div>
	</div>

	<!-- edit modal -->
	<div class="modal fade" id="ModModal" tabindex="-1" role="dialog" aria-labelledby="ModModal" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-scrollable" role="document">
    		<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title">Modifier Etablissement</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
      			<div class="modal-body">
					<label for="uname">ID</label>
					<input type="text" id="uname" class="form-control" 
						v-model="clickedData.idEtab" readonly>

					<label for="nom">Nom</label>
					<input type="text" id="nom" class="form-control" name="nom"
						v-model="clickedData.NomEtab" required>

					<label for="EMAIL">EMAIL</label>
					<input type="email" id="EMAIL" class="form-control" 
						v-model="clickedData.email" required>

					<label for="TEL">TEL</label>
					<input type="tel" id="TEL" class="form-control" 
						v-model="clickedData.tel" required>

					<label for="ADRESS">ADRESS</label>
					<input type="text" id="ADRESS" class="form-control" 
						v-model="clickedData.adress" required>

					<label for="VILLE">VILLE</label>
					<input type="text" id="VILLE" class="form-control" 
						v-model="clickedData.ville" required>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" 
						data-dismiss="modal">Annuler</button>
					<button type="button" class="btn btn-primary" 
						data-dismiss="modal" @click="updateData();">Modifier</button>
				</div>
			</div>
		</div>
	</div>



	<!-- delete Modal -->
	<div class="modal fade" id="SupModel" tabindex="-1" role="dialog" aria-labelledby="SupModel" aria-hidden="true">
  		<div class="modal-dialog modal-dialog-centered" role="document">
    		<div class="modal-content">
      			<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Supprimer Etablissement</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
      			</div>
				<div class="modal-body">
					<p>Etes-vous sûr que vous voulez supprimer ?</p>
					<h3>{{clickedData.NomEtab}}</h3>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" 
							data-dismiss="modal">Annuler</button>
					<button type="button" class="btn btn-danger" 
							data-dismiss="modal" @click="deleteData();">Supprimer</button>
				</div>
 		   </div>
 		 </div>
	</div>


		<?php require_once('footer.php'); ?>

