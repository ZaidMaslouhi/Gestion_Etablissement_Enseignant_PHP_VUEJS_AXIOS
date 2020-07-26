
var app = new Vue({
  el: "#root",
  data: {
  	errorMessage: "",
	successMessage: "",
  	data: [],
  	dataFtr: [],
  	newData: {},
	clickedData: {},
	etabs: [],
	enss: [],
	search: "",
	currentPage: 'Etablissement',
	apiUrl: '',
	myUrl : 'http://localhost:8080/DCA_Project/api/'
  },

  mounted: function() {
	this.Routing();	
	this.getAlldata();
	if(this.currentPage === 'Enseignant') this.getAllEtabs();
	if(this.currentPage === 'Charges') this.getAllEns();
  },

  methods: {
	Routing: function(){
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

  	getAlldata: function() {
  		axios.get(this.apiUrl + '?action=read')
  		.then((response)=> {
				app.data = response.data;
				app.dataFtr = app.data;
				app.search = '';
  		});
	},
	  
	getAllEtabs: function(){
		axios.get(this.myUrl + 'TraitementsEtablissement.service.php' + '?action=read')
		.then((response)=> {
			  app.etabs = response.data;
		})
	},

	getAllEns: function(){
		axios.get(this.myUrl + 'TraitementsEnseignant.service.php' + '?action=read')
		.then((response) =>{
			  app.enss = response.data;
		})
	},

  	addData: function(){
		if(app.currentPage === 'Enseignant') app.initializeData('add');
		var formData = app.toFormData(app.newData);
		axios.post(app.apiUrl + '?action=add', formData)
  		.then((response)=> {
  			app.newData = {};
  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
				  app.data = [];
				  app.dataFtr = [];
  				app.getAlldata();
  			}
  		});
  	},

  	updateData: function(){
		if(app.currentPage === 'Enseignant') app.initializeData('update');
  		var formData = app.toFormData(app.clickedData);
  		axios.post(app.apiUrl + '?action=update', formData)
  		.then((response)=> {
  			app.clickedData = {};
  			if (response.data.error) {
				app.errorMessage = response.data.message;
  			} else {
				app.successMessage = response.data.message;
  			}
  		}).then(()=>{
				app.getAlldata();
		});
  	},

  	deleteData: function(){
  		var formData = app.toFormData(app.clickedData);
  		axios.post(app.apiUrl + '?action=delete', formData)
  		.then((response)=> {
  			app.clickedData = {};

  			if (response.data.error) {
  				app.errorMessage = response.data.message;
  			} else {
  				app.successMessage = response.data.message;
  				app.getAlldata();
  			}
  		})
  	},

  	selectData: (data)=> {
		  app.clickedData = data;
  	},

  	toFormData: (obj)=> {
  		var form_data = new FormData();
  		for (var key in obj) {
  			form_data.append(key, obj[key]);
  		}
  		return form_data;
  	},

  	clearMessage: ()=> {
  		app.errorMessage   = "";
		app.successMessage = "";
	},

	filterData: ()=>{
		if(app.currentPage === 'Etablissement'){
			app.dataFtr = app.data.filter(res =>
				res.NomEtab.toLowerCase().includes(app.search.toLowerCase()))
		}else{
			app.dataFtr = app.data.filter(res =>
			res.NomEnsei.toLowerCase().includes(app.search.toLowerCase()))
		}
	},

	initializeData: (action)=>{
		let ref;
		(action === 'add')? ref = app.newData : ref = app.clickedData;
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
