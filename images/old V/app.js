
var app = new Vue({

  el: "#root",
  data: {
  	showingaddModal: false,
  	showingeditModal: false,
  	showingdeleteModal: false,
  	errorMessage: "",
  	successMessage: "",
  	users: [],
  	usersFtr: [],
  	newUser: {},
	clickedUser: {},
	etabs: [],
	enss: [],
	search: "",
	currentPage: 'Etablissement',
	apiUrl: '',
	myUrl : 'http://localhost:8080/DCA_Project/api/'
  },

  mounted: function () {
	console.log('Vue is Running..');
	this.Routing();
	
	this.getAllUsers();
	if(this.currentPage === 'Enseignant') this.getAllEtabs();
	if(this.currentPage === 'Charges') this.getAllEns();
  },

  methods: {
	Routing(){
		pathUrl = window.location.pathname;
		if(pathUrl.includes('Etablissement')){
				this.currentPage = 'Etablissement'; 
				this.apiUrl = this.myUrl + 'TraitementsEtablissement.service.php';
		}else if(pathUrl.includes('Enseignant')){
				this.currentPage = 'Enseignant'; 
				this.apiUrl = this.myUrl + 'TraitementsEnseignant.service.php';
		}else{
			this.currentPage = 'Charges'; 
			this.apiUrl = this.myUrl + 'TraitementsCharges.service.php';
		}
	},

  	getAllUsers: function () {
  		axios.get(this.apiUrl + '?action=read')
  		.then(function (response) {

			// console.log(response);
				app.users = response.data;
				app.usersFtr = app.users;
				this.search = '';
  		})
	},
	  
	getAllEtabs: function(){
		axios.get(this.myUrl + 'TraitementsEtablissement.service.php' + '?action=read')
		.then(function (response) {
			  app.etabs = response.data;
		})
	},

	getAllEns: function(){
		axios.get(this.myUrl + 'TraitementsEnseignant.service.php' + '?action=read')
		.then(function (response) {
			  app.enss = response.data;
		})
	},

  	addUser: function () {
		if(this.currentPage === 'Enseignant') app.initializeData('add');
		  var formData = app.toFormData(app.newUser);
		  axios.post(this.apiUrl + '?action=add', formData)
  		.then(function (response) {
  			app.newUser = {};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  				console.log(response.data.message);
  			} else {
  				app.successMessage = response.data.message;
  				console.log(response.data.message);
  				app.getAllUsers();
  			}
  		});
  	},

  	updateUser: function () {
		if(this.currentPage === 'Enseignant') app.initializeData('update');
		
  		var formData = app.toFormData(app.clickedUser);
  		axios.post(this.apiUrl + '?action=update', formData)
  		.then(function (response) {
  			app.clickedUser = {};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAllUsers();
  			}
  		});
  	},

  	deleteUser: function () {
  		var formData = app.toFormData(app.clickedUser);
  		axios.post(this.apiUrl + '?action=delete', formData)
  		.then(function (response) {
  			app.clickedUser = {};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAllUsers();
  			}
  		})
  	},

  	selectUser(user) {
		  app.clickedUser = user;
  	},

  	toFormData(obj) {
  		var form_data = new FormData();
  		for (var key in obj) {
  			form_data.append(key, obj[key]);
  		}
  		return form_data;
  	},

  	clearMessage() {
  		app.errorMessage   = "";
		app.successMessage = "";
	},

	filterData(){
		if(this.currentPage === 'Etablissement'){
			this.usersFtr = this.users.filter(res =>
				res.NomEtab.toLowerCase().includes(this.search.toLowerCase()))
			console.log(this.search);
		}else if(this.currentPage === 'Enseignant'){
			this.usersFtr = this.users.filter(res =>
			res.NomEnsei.toLowerCase().includes(this.search.toLowerCase()))
		}
		else{
			this.usersFtr = this.users.filter(res =>
			res.idCharges.toLowerCase().includes(this.search.toLowerCase()))
		}
	},

	initializeData(action){
		let ref;
		(action === 'add')? ref = app.newUser : ref = app.clickedUser;
		switch(ref.Grade){
			case 'PA': ref.PrixHeure = 220; 
						ref.HeureEnsei = 360; break;
			case 'PH': ref.PrixHeure = 250;
						ref.HeureEnsei = 370; break;
			case 'PES': ref.PrixHeure = 277;
						ref.HeureEnsei = 300; break;
		}
		if(ref.TypeEnsei == 'Vacataire') ref.HeureEnsei = null;
	}

  }

});
