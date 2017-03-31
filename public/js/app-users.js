Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");
Vue.config.devtools = true;

new Vue({

    el: '#user_area',

    data: {
        categories: [],
        formErrors:{},
        formErrorsUpdate:{},
        formErrorsCompleteRegister:{},
        newEnterprise : {'category_id': '','name': '','contact': '','email': '','telephone': '','address': ''},
        updatePassword : {'currentPassword':'','password':'','id':''},
        fillUser: {
            'photo':'',
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
        }
    },

    ready : function(){
        this.getCategories();
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

        changePassword: function(id){
            var input = this.updatePassword;
            this.$http.post('/app/alterar-senha/'+id,input).then((response) => {
                this.updatePassword = {'password':'','id':''};
                $("#changePasswordModal").modal('hide');
                toastr.success('Senha alterada com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrorsUpdate = response.data;
            });
        },

        updateUser: function(id){
            var input = this.fillUser;
            this.$http.put('/app/usuario/'+id,input).then((response) => {
                this.fillUser = {
                    'photo':'',
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
                $("#completeRegister").modal('hide');
                toastr.success('Dados atualizados com sucesso!', '', {timeOut: 5000});
            }, (response) => {
                this.formErrorsCompleteRegister = response.data;
            });
        }

    }

});