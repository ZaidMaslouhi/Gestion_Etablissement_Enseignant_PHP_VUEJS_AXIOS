
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
							<td><button @click="showingeditModal = true; selectData(data);" class="btn btn-warning">Modifier</button></td>
							<td><button @click="showingdeleteModal = true; selectData(data);" class="btn btn-danger">Supprimer</button></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>

	<!-- Ajouter modal -->
		<div class="modal col-md-6" id="addmodal" v-if="showingaddModal">
				<div class="modal-head">
					<p class="p-left p-2">Ajouter Etablissement</p>
					<hr/>
					<div class="modal-body">
						<div class="col-md-12">
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
						<hr/>
						<button type="button" class="btn btn-success"  @click="showingaddModal = false; addData();">Ajouter</button>
						<button type="button" class="btn btn-danger"   @click="showingaddModal = false;">Annuler</button>
					</div>
				</div>
			</div>

	<!-- edit modal -->
		<div class="modal col-md-6" id="editmodal" v-if="showingeditModal">
			<div class="modal-head">
				<p class="p-left p-2">Modifier Etablissement</p>
				<hr/>
				<div class="modal-body">
					<div class="col-md-12">
						<label for="uname">ID</label>
						<input type="text" id="uname" class="form-control" 
							v-model="clickedData.idEtab" readonly>

						<label for="email">Nom</label>
						<input type="text" id="email" class="form-control" 
							v-model="clickedData.NomEtab">
						
						<label for="EMAIL">EMAIL</label>
						<input type="email" id="EMAIL" class="form-control" 
							v-model="clickedData.email">

						<label for="TEL">TEL</label>
						<input type="tel" id="TEL" class="form-control" 
							v-model="clickedData.tel">

						<label for="ADRESS">ADRESS</label>
						<input type="text" id="ADRESS" class="form-control" 
							v-model="clickedData.adress">

						<label for="VILLE">VILLE</label>
						<input type="text" id="VILLE" class="form-control" 
							v-model="clickedData.ville">
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
					<p class="p-left p-2">Supprimer Etablissement</p>
					<hr/>
					<div class="modal-body">
							<p>Etes-vous sûr que vous voulez supprimer ?</p>
							<h3>{{clickedData.NomEtab}}</h3>
						
						<hr/>
							<button type="button" class="btn btn-danger"  @click="showingdeleteModal = false; deleteData();">Supprimer</button>
							<button type="button" class="btn btn-dark"   @click="showingdeleteModal = false;">Annuler</button>
					</div>
				</div>
			</center>
		</div>

		<?php require_once('footer.php'); ?>

