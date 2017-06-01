Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");
Vue.config.devtools = true;

new Vue({

    el: '#user_area',

    data: {
        categories: [],
        formErrors: {},
        formErrorsUpdate: {},
        formErrorsCompleteRegister: {},
        formPhoto: {},
        newEnterprise: {'category_id': '','name': '','contact': '','email': '','telephone': '','address': ''},
        updatePassword: {'currentPassword':'','password':'','id':''},
        fillUser: {
            'name':'',
            'surName':'',
            'gender':'',
            'dateOfBirth':'',
            'telephone':'',
            'city':'',
            'state':'',
            'country':'',
            'email':'',
            'education':'',
            'profession':'',
            'maritalStatus':'',
            'religion':'',
            'ethnicity':'',
            'income':'',
            'sport':'',
            'soccerTeam':'',
            'height':'',
            'weight':'',
            'hasCar':'',
            'hasChildren':'',
            'liveWith':'',
            'pet':''
        },
        newEnterpriseThanks: {'enterprise_id': '','content': ''},
        newUserThanks: {'receiptName':'','receiptEmail':'','content': ''},
        photo: null
    },

    ready : function(){
        this.getCategories();
        this.fetchCountryData();
    },

    methods : {

        getCategories: function(page){
            this.$http.get('/app/categorias').then((response) => {
                this.$set('categories', response.data);
            });
        },

        createEnterprise: function(){
            var input = this.newEnterprise;
            this.$http.post('/app/empresa',input).then((response) => {
                this.newEnterprise = {'category_id': '','name':'','contact': '','email':'','telephone': '','address': ''};
                $("#createEnterprise").modal('hide');
                toastr.success('Cadastro realizado com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            });
        },

        fetchCountryData: function () {
            /*var self = this;
            this.$http.get('http://agradecaaqui.localhost/paises.json', function( data ) {
                //self.items = data;
                console.log(data);
            });*/

            this.$http.get('http://agradecaaqui.localhost/paises.json').then(function(response) { 
                console.log(response.json());
            }).catch(function(error) { 
                console.error(error); 
            });

        },

        changePassword: function(id){
            var input = this.updatePassword;
            this.$http.post('/app/alterar-senha',input).then((response) => {
                console.log(response);
                if(response.data.status == true) {
                    this.updatePassword = {'password':'','id':''};
                    $("#changePasswordModal").modal('hide');
                    toastr.success('Senha alterada com sucesso!', '', {timeOut: 5000});
                } else {
                    toastr.error('A Senha atual não confere!', '', {timeOut: 5000});
                }
                
            }, (response) => {
                this.formErrorsUpdate = response.data;
            });
        },

        updateUser: function(id){
            var input = this.fillUser;
            this.$http.put('/app/usuario/'+id,input).then((response) => {
                this.fillUser = {
                    'name':'',
                    'surName':'',
                    'gender':'',
                    'dateOfBirth':'',
                    'telephone':'',
                    'city':'',
                    'state':'',
                    'country':'',
                    'email':'',
                    'education':'',
                    'profession':'',
                    'maritalStatus':'',
                    'religion':'',
                    'ethnicity':'',
                    'income':'',
                    'sport':'',
                    'soccerTeam':'',
                    'height':'',
                    'weight':'',
                    'hasCar':'',
                    'hasChildren':'',
                    'liveWith':'',
                    'pet':'',
                    'id':''};
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrorsCompleteRegister = response.data;
            });
        },

        updatePhoto: function(id){
            var form = document.querySelector('#photo');
            var file = form.files[0];
            var data = new FormData();
            var image = data.append("photo", file)

            if (this.photo == null) {
                toastr.error('Por favor, selecione uma imagem.', '', {timeOut: 5000});
            } else {    
                this.$http.post('/app/alterar-avatar/'+id,data).then((response) => {
                    this.photo = null;
                    toastr.success('Foto atualizada com sucesso!', '', {timeOut: 5000});
                    setTimeout(function(){window.location.href = '/app'} , 5000);
                }, (response) => {
                    this.formPhoto = response.data;
                });
            }
            
        },

        storeEnterpriseThanks: function(){
            var input = this.newEnterpriseThanks;
            this.$http.post('/app/agradecimento-empresa',input).then((response) => {
                this.newEnterpriseThanks = {'enterprise_id': '','content': ''};
                toastr.success('Agradecimento realizado com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            });
        },

        storeUserThanks: function(){
            var input = this.newUserThanks;
            this.$http.post('/app/agradecimento-usuario',input).then((response) => {
                this.newUserThanks = {'receiptName':'','receiptEmail':'','content': ''};
                toastr.success('Agradecimento realizado com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrors = response.data;
            });
        },

    }

});